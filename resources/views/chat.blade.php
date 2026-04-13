<x-app-layout>
<div class="flex h-[85vh] bg-gray-100 rounded-xl overflow-hidden shadow">

    <!-- LEFT: Patient List -->
    <div class="w-1/3 bg-white border-r flex flex-col">
        
        <div class="p-4 font-bold text-lg border-b bg-blue-600 text-white">
            Chats
        </div>

        <div class="overflow-y-auto flex-1">
            @foreach($patients as $patient)
                <div onclick="loadChat({{ $patient->id }}, '{{ $patient->name }}')"
                     class="flex items-center gap-3 p-3 cursor-pointer hover:bg-gray-100 border-b">

                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                        {{ strtoupper(substr($patient->name,0,1)) }}
                    </div>

                    <div>
                        <div class="font-medium">{{ $patient->name }}</div>
                        <div class="text-xs text-gray-500">Click to chat</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- RIGHT: Chat Area -->
    <div class="w-2/3 flex flex-col">

        <!-- Header -->
        <div id="chat-header" class="p-4 bg-white border-b font-semibold text-gray-700">
            Select a patient to start chat
        </div>

        <!-- Messages -->
        <div id="messages" class="flex-1 overflow-y-auto p-4 space-y-2 bg-[#efeae2]"></div>

        <!-- Input -->
        <div class="p-3 bg-white flex items-center gap-2 border-t">
            <input id="msg"
                   class="flex-1 border rounded-full px-4 py-2 focus:outline-none"
                   placeholder="Type a message..." />

            <button onclick="sendMsg()"
                    class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700">
                Send
            </button>
        </div>

    </div>
</div>

<script>
let currentPatient = null;

function loadChat(id, name){
    currentPatient = id;

    document.getElementById("chat-header").innerText = name;

    fetch(`/get-messages/${id}`)
    .then(res => res.json())
    .then(data => {
        let html = "";

        data.forEach(m => {
            if(m.sender_type === 'user'){
                html += `
                <div class="flex justify-end">
                    <div class="bg-blue-500 text-white px-4 py-2 rounded-lg max-w-xs">
                        ${m.message}
                    </div>
                </div>`;
            } else {
                html += `
                <div class="flex justify-start">
                    <div class="bg-white px-4 py-2 rounded-lg max-w-xs">
                        ${m.message}
                    </div>
                </div>`;
            }
        });

        document.getElementById("messages").innerHTML = html;
        scrollDown();
    });
}

function sendMsg(){
    let msg = document.getElementById("msg").value;

    if(!msg || !currentPatient) return;

    fetch('/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            patient_id: currentPatient,
            message: msg
        })
    }).then(() => {
        document.getElementById("msg").value = "";
        loadChat(currentPatient, document.getElementById("chat-header").innerText);
    });
}

function scrollDown(){
    let box = document.getElementById("messages");
    box.scrollTop = box.scrollHeight;
}
</script>
</x-app-layout>