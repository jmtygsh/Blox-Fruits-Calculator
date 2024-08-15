$(document).ready(function() {
    $('#messageForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                // console.log(response)
                $('#messageInput').val('');
                $('#messagesList').append(
                    `<li id="sender" class="max-w-2xl ms-auto flex justify-end gap-x-2 sm:gap-x-4">
                        <div class="grow text-end space-y-3">
                            <div class="inline-block bg-blue-600 rounded-lg p-2 shadow-sm">
                                <p class="text-sm text-white">${response.chat}</p>
                            </div>
                        </div>
                        <div>
                            <span class="shrink-0 inline-flex items-center justify-center size-[35px] rounded-full bg-gray-600">
                                <span class="text-sm font-medium text-white leading-none">${authNameInitial}</span>
                            </span>
                        </div>
                    </li>`
                );
            },
            error: function(response) {
                alert('An error occurred. Please try again.');
                console.log(response);
            }
        });
    });

    const authID = window.authID; // Authenticated user ID
    const sID = window.sID; // ID of the user you're chatting with

    window.Echo.private(`chatChannel.${authID}`)
        .listen('MessageSent', (e) => {
            // console.log('Message Receive', e)
            if (e.message.sender.id == sID) {
                const senderName = e.message.sender?.name || 'Unknown Sender';
                $('#messagesList').append(`
                    <li id="receiver" class="flex gap-x-2 sm:gap-x-4">
                        <span class="shrink-0 inline-flex items-center justify-center size-[35px] rounded-full bg-gray-600">
                            <span class="text-sm font-medium text-white leading-none">${senderName.substring(0, 1).toUpperCase()}</span>
                        </span>
                        <div class="bg-white border border-gray-200 rounded-lg p-2 space-y-3 dark:bg-neutral-900 dark:border-neutral-700">
                            <p class="font-medium text-gray-800 dark:text-white">${e.message.message}</p>
                        </div>
                    </li>`
                );
            }
        });
});
