@extends('frontend.dashboard.layouts.master')

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-star" aria-hidden="true"></i> Message</h3>
                        <div class="wsus__dashboard_review">
                            <div class="row">
                                <div class="col-xl-4 col-md-5">
                                    <div class="wsus__chatlist d-flex align-items-start">
                                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <h2>Seller List</h2>
                                            <div class="wsus__chatlist_body">
                                                @foreach ($chatUsers as $chatUser)
                                                    @php
                                                        $unseenMessages = \App\Models\Chat::where([
                                                            'sender_id' => $chatUser->receiverProfile->id,
                                                            'receiver_id' => auth()->user()->id,
                                                            'seen' => 0,
                                                        ])->exists();
                                                    @endphp
                                                    <button class="nav-link chat-user-profile"
                                                        data-id="{{ $chatUser->receiverProfile->id }}" data-bs-toggle="pill"
                                                        data-bs-target="#v-pills-home" type="button" role="tab"
                                                        aria-controls="v-pills-home" aria-selected="true">
                                                        <div
                                                            class="wsus_chat_list_img {{ $unseenMessages ? 'msg-notification' : '' }}">
                                                            <img src="{{ asset($chatUser->receiverProfile->image) }}"
                                                                alt="user" class="img-fluid">
                                                            <span class="pending d-none" id="pending-6">0</span>
                                                        </div>
                                                        <div class="wsus_chat_list_text">
                                                            <h4>{{ $chatUser->receiverProfile->name }}</h4>
                                                        </div>
                                                    </button>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-md-7">
                                    <div class="wsus__chat_main_area">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show" id="v-pills-home" role="tabpanel"
                                                aria-labelledby="v-pills-home-tab">
                                                <div id="chat_box">
                                                    <div class="wsus__chat_area"
                                                        style="position: relative;
                                                        height: 70vh;">

                                                        <div class="wsus__chat_area_header">
                                                            <h2 id="chat-inbox-title">Chat with Daniel Paul</h2>
                                                        </div>
                                                        <div class="wsus__chat_area_body" data-inbox="">

                                                        </div>
                                                        <div class="wsus__chat_area_footer"
                                                            style="width: 100%; padding: 10px; border-top: 1px solid #ccc;">
                                                            <form id="message-form">
                                                                @csrf
                                                                <input type="text" placeholder="Type Message"
                                                                    class="message-box" autocomplete="off" name="message">
                                                                <input type="hidden" name="receiver_id" value=""
                                                                    id="receiver_id">
                                                                <button type="submit"><i
                                                                        class="fas fa-paper-plane send-button"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const mainChatInbox = $('.wsus__chat_area_body');
        let currentReceiverId = null;
        let currentSenderImage = null;

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
                var messageHtml = `<div class="wsus__chat_single single_chat_2">
                        <div class="wsus__chat_single_img">
                            <img src="${USER.image}"
                                alt="user" class="img-fluid">
                        </div>
                        <div class="wsus__chat_single_text">
                            <p>${message}</p>
                            <span>${formatDateTime(new Date())}</span>
                        </div>
                    </div>`
            } else {
                var messageHtml = `<div class="wsus__chat_single">
                        <div class="wsus__chat_single_img">
                            <img src="${senderImage}"
                                alt="user" class="img-fluid">
                        </div>
                        <div class="wsus__chat_single_text">
                            <p>${message}</p>
                            <span>${formatDateTime(new Date())}</span>
                        </div>
                    </div>`
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
                                url: '{{ route('user.mark-message-seen') }}',
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
            $(`.chat-user-profile[data-id="${messageData.sender_id}"] .wsus_chat_list_img`).addClass('msg-notification');

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
                let senderImage = $(this).find('img').attr('src');
                let chatUserName = $(this).find('h4').text();

                currentReceiverId = receiverId;
                currentSenderImage = senderImage;

                mainChatInbox.attr('data-inbox', receiverId);
                $('#receiver_id').val(receiverId);
                $(this).find('.wsus_chat_list_img').removeClass('msg-notification');

                $.ajax({
                    method: 'get',
                    url: '{{ route('user.get-messages') }}',
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
                                senderImage);
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
                    url: '{{ route('user.send-message') }}',
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
