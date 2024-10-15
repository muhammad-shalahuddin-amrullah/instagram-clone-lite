<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body class="bg-white text-black font-sans">
    <div class="max-w-screen-sm mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <img src="{{ asset('/images/logo-instagram.png') }}" alt="Instagram" class="h-8">
            <div class="relative">
                <div class="flex items-center">
                    <i class="fas fa-bell text-xl relative">
                        <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-2 h-2"></span>
                    </i>
                    <form action="{{ route('profile.logout', ['username' => auth()->user()->username]) }}" method="post">
                            @csrf
                            <button class="ml-4 text-gray-600 hover:text-gray-900" type="submit">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                </div>
            </div>
        </div>

        <!-- Feed -->
        <div class="mx-4 mb-16">
            @foreach($posts as $post)
                <div class="max-w-md mx-auto mt-4">
                    <div class="border border-gray-300 rounded-lg shadow-lg mb-4">
                        <div class="p-4">
                            <div class="flex items-center space-x-2">
                                    <img src="{{ url($post->user->profile_picture) }}" alt="User profile picture" class="w-10 h-10 rounded-full">
                                    <span class="font-bold">{{ $post->user->username }}</span>
                                <i class="fas fa-ellipsis-h ml-auto"></i>
                            </div>
                            <div class="mt-4">
                                @if(strpos($post->file_type, 'image') !== false)
                                    <img src="{{ asset($post->file) }}" alt="Post image" class="w-full rounded-lg">
                                @elseif(strpos($post->file_type, 'video') !== false)
                                    <video controls class="w-full rounded-lg">
                                        <source src="{{ asset($post->file) }}" type="{{ $post->file_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                            <div class="mt-4">
                                <div class="flex items-center space-x-2">
                                    <i class="far fa-heart text-2xl"></i>
                                    <i class="far fa-comment text-2xl" onclick="openModal('{{ $post->id }}')"></i>
                                    <i class="far fa-paper-plane text-2xl"></i>
                                    <i class="far fa-bookmark text-2xl ml-auto"></i>
                                </div>
                                <div class="mt-2">
                                    <span class="font-bold">{{ $post->likes_count ?? 0 }} likes</span>
                                </div>
                                <div class="mt-2">
                                    <span class="font-bold">{{ $user->username }}</span>
                                    <span>{{ $post->caption }}</span>
                                </div>
                                <div class="mt-2 text-gray-500">
                                    <span onclick="openModal('{{ $post->id }}')">... more</span>
                                </div>
                                <div class="mt-2 text-gray-500">
                                    <span onclick="openModal('{{ $post->id }}')">View all {{ $post->comments_count ?? 0 }} comments</span>
                                </div>
                                <div class="mt-2 text-gray-500">
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t">
            <div class="flex justify-around py-2">
            <a href="{{ route('profile.home', ['username' => auth()->user()->username]) }}">
                        <i class="fas fa-home text-xl"></i>
                    </a>
                <i class="fas fa-search text-xl"></i>
                <i class="fas fa-plus text-xl cursor-pointer" onclick="toggleUploadModal()"></i>
                <i class="fas fa-comment-dots text-xl"></i>
                <a href="{{ route('profile.index', ['username' => auth()->user()->username]) }}">
                        <img src="https://picsum.photos/200" alt="Profile picture" class="w-6 h-6 rounded-full self-center">
                    </a>
            </div>
        </div>
    </div>


    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-4 rounded-lg max-w-md w-full">
            <h2 class="text-xl font-semibold mb-4">Upload Photo/Video</h2>
            <form action="{{ route('profile.create-post', ['username' => auth()->user()->username]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="mb-4" required>
                <textarea name="caption" class="w-full p-2 border rounded mb-4" placeholder="Write a caption..."></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Post</button>
                <button type="button" class="mt-4 bg-red-500 text-white px-4 py-2 rounded" onclick="toggleUploadModal()">Close</button>
            </form>
        </div>
    </div>

    <script>

        function toggleUploadModal() {
            const modal = document.getElementById('uploadModal');
            modal.classList.toggle('hidden');
        }

        function openModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.remove('hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            modal.classList.add('hidden');
        }

        function addComment(id) {
            const commentInput = document.getElementById(`comment-input-${id}`);
            const commentList = document.getElementById(`comment-list-${id}`);
            const newComment = document.createElement('div');
            newComment.classList.add('mt-2');
            newComment.innerHTML = `<span class="font-bold">your_username</span> <span>${commentInput.value}</span>`;
            commentList.appendChild(newComment);
            commentInput.value = '';
        }
    </script>
</body>
</html>
