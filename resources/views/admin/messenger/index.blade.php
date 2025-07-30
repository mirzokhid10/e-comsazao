@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Messages</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Chat Box</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row align-items-center justify-content-center">
                <div class="col-md-3">
                    <div class="card" style="height: 70vh;">
                        <div class="card-header">
                            <h4>Who's Online?</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($chatUsers as $chatUser)
                                    @php
                                        $unseenMessages = \App\Models\Chat::where([
                                            'sender_id' => $chatUser->senderProfile->id,
                                            'receiver_id' => auth()->user()->id,
                                            'seen' => 0,
                                        ])->exists();
                                    @endphp
                                    <li class="media chat-user-profile" data-id="{{ $chatUser->senderProfile->id }}">
                                        <img alt="image"
                                            class="mr-3 rounded-circle {{ $unseenMessages ? 'msg-notification' : '' }}"
                                            width="50" src="{{ asset($chatUser->senderProfile->image) }}">
                                        <div class="media-body">
                                            <div class="mt-0 mb-1 font-weight-bold chat-user-name">
                                                {{ $chatUser->senderProfile->name }}</div>
                                            {{-- <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div> --}}
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card chat-box d-none" id="mychatbox" style="height: 70vh;">
                        <div class="card-header">
                            <h4 id="chat-inbox-title">Chat with Rizal</h4>
                        </div>
                        <div class="card-body chat-content" data-inbox="">

                        </div>
                        <div class="card-footer chat-form">
                            <form id="message-form">
                                @csrf
                                <input type="text" class="form-control message-box" placeholder="Type a message"
                                    name="message">
                                <input type="hidden" name="receiver_id" value="" id="receiver_id">

                                <button class="btn btn-primary">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const mainChatInbox = $('.chat-content');
        let currentReceiverId = null;
        let currentReceiverImage = null;

        function formatDateTime(dateTimeString) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            }
            const formatedDateTime = new Intl.DateTimeFormat('en-Us', options).format(new Date(dateTimeString));
            return formatedDateTime;
        }

        function scrollTobottom() {
            mainChatInbox.scrollTop(mainChatInbox.prop("scrollHeight"));
        }

        function addMessageToChat(message, senderId, senderImage, isNewMessage = false) {
            if (senderId == USER.id) {
                var messageHtml = `
                <div class="chat-item chat-right" style=""><img style="height: 50px;
                object-fit: cover;" src="${USER.image}"><div class="chat-details"><div class="chat-text">${message}</div><div class="chat-time">${formatDateTime(new Date())}</div></div></div>
                `
            } else {
                var messageHtml = `
                <div class="chat-item chat-left" style=""><img src="${senderImage}"><div class="chat-details"><div class="chat-text">${message}</div><div class="chat-time">${formatDateTime(new Date())}</div></div></div>
                `
            }

            mainChatInbox.append(messageHtml);

            if (isNewMessage) {
                scrollTobottom();
            }
        }

        // Initialize Echo listener for real-time messages
        function initializeEchoListener() {
            console.log('Initializing Echo listener...');
            console.log('USER object:', USER);
            console.log('Echo object:', window.Echo);

            if (window.Echo) {
                try {
                    const channel = window.Echo.private(`message.${USER.id}`);
                    console.log('Channel created:', channel);

                    channel.listen('MessageEvent', (e) => {
                        console.log('New message received:', e);

                        // Check if the message is from the currently open chat
                        if (currentReceiverId && e.sender_id == currentReceiverId) {
                            // Add message to current chat
                            addMessageToChat(e.message, e.sender_id, e.sender_image, true);

                            // Mark message as seen
                            $.ajax({
                                method: 'POST',
                                url: '{{ route('admin.mark-message-seen') }}',
                                data: {
                                    sender_id: e.sender_id,
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                        } else {
                            // Show notification for new message from other user
                            showMessageNotification(e);
                        }
                    });

                    console.log('Echo listener initialized successfully');
                } catch (error) {
                    console.error('Error initializing Echo listener:', error);
                }
            } else {
                console.error('Echo is not available');
            }
        }

        function showMessageNotification(messageData) {
            // Add notification indicator to user in chat list
            $(`.chat-user-profile[data-id="${messageData.sender_id}"] img`).addClass('msg-notification');

            // Show toast notification
            if (typeof toastr !== 'undefined') {
                toastr.info(`New message from ${messageData.sender_name || 'User'}`);
            }
        }

        $(document).ready(function() {
            // Initialize Echo listener
            initializeEchoListener();

            $('.chat-user-profile').on('click', function() {
                let receiverId = $(this).data('id');
                let receiverImage = $(this).find('img').attr('src')
                let chatUserName = $(this).find('.chat-user-name').text();

                currentReceiverId = receiverId;
                currentReceiverImage = receiverImage;

                $(this).find('img').removeClass('msg-notification');
                $('.chat-box').removeClass('d-none');
                mainChatInbox.attr('data-inbox', receiverId);
                $('#receiver_id').val(receiverId);

                $.ajax({
                    method: 'get',
                    url: '{{ route('admin.get-message') }}',
                    data: {
                        receiver_id: receiverId
                    },
                    beforeSend: function() {
                        mainChatInbox.html("");
                        // set chat inbox title
                        $('#chat-inbox-title').text(`Chat With ${chatUserName}`)
                    },
                    success: function(response) {
                        $.each(response, function(index, value) {
                            addMessageToChat(value.message, value.sender_id,
                                value.sender_id == USER.id ? USER.image :
                                receiverImage);
                        });

                        // scroll to bottom
                        scrollTobottom();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading messages:', error);
                    }
                })
            })

            $('#message-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let messageData = $('.message-box').val();

                var formSubmitting = false;

                if (formSubmitting || messageData === "") {
                    return;
                }

                // Add message to chat immediately for better UX
                addMessageToChat(messageData, USER.id, USER.image, true);
                $('.message-box').val('');

                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.send-message') }}',
                    data: formData,
                    beforeSend: function() {
                        $('.send-button').prop('disabled', true);
                        formSubmitting = true;
                    },
                    success: function(response) {
                        // Message sent successfully
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseJSON.message);
                        $('.send-button').prop('disabled', false);
                        formSubmitting = false;
                    },
                    complete: function() {
                        $('.send-button').prop('disabled', false);
                        formSubmitting = false;
                    }
                })
            })
        })
    </script>
@endpush
