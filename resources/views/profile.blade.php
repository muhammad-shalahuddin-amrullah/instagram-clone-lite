<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center cursor-pointer" onclick="toggleSettingsModal()">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h1 class="ml-4 text-lg font-semibold">{{ $user->username }}</h1>
                    <i class="fas fa-chevron-down ml-2"></i>
                </div>
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
            <!-- Profile Info -->
            <div class="p-4">
                <div class="flex items-center">
                    <img src="{{ url($user->profile_picture) }}" alt="Profile picture" class="w-20 h-20 rounded-full">
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold">{{ $user->username }}</h2>
                        <div class="flex mt-2">
                            <button class="bg-gray-200 text-black px-4 py-1 rounded mr-2" onclick="unhideEditProfileModal()">Edit profile</button>
                            <button class="bg-gray-200 text-black px-4 py-1 rounded" onclick="toggleArchiveModal()">View archive</button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h3 class="font-semibold">{{ $user->name }}</h3>
                    @if($user->bio)
                    <p>{{ $user->bio }}</p>
                @endif
                </div>
            </div>
            <!-- Stories -->
            <div class="flex space-x-2 px-4">
                <div class="flex flex-col items-center">
                    <img src="https://picsum.photos/200" alt="Story 1" class="w-16 h-16 rounded-full border">
                    <span class="text-xs mt-1">w/ u ♡˖</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://picsum.photos/200" alt="Story 2" class="w-16 h-16 rounded-full border">
                    <span class="text-xs mt-1">dsadsad</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://picsum.photos/200" alt="Story 3" class="w-16 h-16 rounded-full border">
                    <span class="text-xs mt-1">Tiba-Tiba ...</span>
                </div>
            </div>
            <!-- Stats -->
            <div class="flex justify-around border-t border-b py-4 mt-4">
                <div class="text-center">
                    <span class="font-semibold">41</span>
                    <p class="text-gray-500 text-sm">posts</p>
                </div>
                <div class="text-center">
                    <span class="font-semibold">106</span>
                    <p class="text-gray-500 text-sm">followers</p>
                </div>
                <div class="text-center">
                    <span class="font-semibold">224</span>
                    <p class="text-gray-500 text-sm">following</p>
                </div>
            </div>
            <!-- Posts -->
            <div id="posts" class="grid grid-cols-3 gap-1 mt-1">
                @foreach($posts as $post)
                    <div class="relative cursor-pointer" onclick="togglePostModal('{{ asset($post->file) }}', '{{ $post->created_at->format('Y-m-d') }}', '{{ $post->caption }}', '{{ $post->file_type }}')" style="width: 100%; height: 0; padding-bottom: 100%;">
                        @if(strpos($post->file_type, 'video') !== false)
                            <video src="{{ asset($post->file) }}" class="absolute top-0 left-0 w-full h-full object-cover" muted></video>
                            <i class="fas fa-video absolute top-2 right-2 text-white"></i>
                        @else
                            <img src="{{ asset($post->file) }}" alt="Post {{ $post->id }}" class="absolute top-0 left-0 w-full h-full object-cover">
                        @endif
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

        <!-- Post Modal -->
        <div id="postModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-4 rounded-lg max-w-md w-full">
        <div class="flex items-center space-x-2 mb-4">
            <img id="postUserImage" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User profile picture" class="w-10 h-10 rounded-full">
            <span id="postUsername" class="font-bold">john_doe</span>
            <span>and <span class="font-bold">150 others</span></span>
            <i class="fas fa-ellipsis-h ml-auto"></i>
        </div>
        <div id="postMediaContainer" class="w-full h-auto mb-4 rounded-lg"></div>
        <div class="flex items-center space-x-2 mb-4">
            <i class="far fa-heart text-2xl"></i>
            <i class="far fa-comment text-2xl"></i>
            <i class="far fa-paper-plane text-2xl"></i>
            <i class="far fa-bookmark text-2xl ml-auto"></i>
        </div>
        <div class="mb-2">
            <span class="font-bold">150 likes</span>
        </div>
        <div class="mb-2">
            <span id="postUsernameCaption" class="font-bold">john_doe</span>
            <span id="postCaption" class="text-black"></span>
        </div>
        <div class="text-gray-500 mb-2">
            <span id="postDate"></span>
        </div>
        <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded" onclick="togglePostModal()">Close</button>
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

        <!-- Edit Profile Modal -->
        <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" onclick="closeModalOnOutsideClick(event)">
            <div class="bg-white p-4 rounded-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
                <form action="{{ route('profile.update', $user->username) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('PUT')
                    <div><label for="profile_picture">Update Profile Picture</label></div>
                    <div><input type="file" name="profile_picture" class="mb-4"></div>
                    @error('profile_picture')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    <input type="text" name="username" value="{{ $user->username }}" class="w-full p-2 border rounded mb-4" placeholder="Username">
                    @error('username')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border rounded mb-4" placeholder="Name">
                    @error('name')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    <textarea name="bio" class="w-full p-2 border rounded mb-4" placeholder="Bio">{{ $user->bio }}</textarea>
                    @error('bio')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                    <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Save</button>
                </form>
            </div>
        </div>

        <!-- Settings Modal -->
        <div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-4 rounded-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">Settings</h2>
                <div class="mb-4">
                    <label class="block mb-2">Feed per line:</label>
                    <select id="feedPerLine" class="w-full p-2 border rounded" onchange="changeFeedPerLine()">
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="toggleArchiveModal()">Enter Archive</button>
                <button type="button" class="mt-4 bg-red-500 text-white px-4 py-2 rounded" onclick="toggleSettingsModal()">Close</button>
            </div>
        </div>

        <!-- Archive Modal -->
        <div id="archiveModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-4 rounded-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">Archive</h2>
                <table class="w-full mb-4">
                    <thead>
                        <tr>
                            <th class="border px-2 py-1">Photo/Video</th>
                            <th class="border px-2 py-1">Post Date</th>
                            <th class="border px-2 py-1">Caption</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-2 py-1"><img src="https://picsum.photos/200.jpg" alt="Post 1" class="w-12 h-12 object-cover"></td>
                            <td class="border px-2 py-1">2023-10-01</td>
                            <td class="border px-2 py-1">Caption for post 1</td>
                        </tr>
                        <tr>
                            <td class="border px-2 py-1"><img src="https://picsum.photos/200.jpg" alt="Post 2" class="w-12 h-12 object-cover"></td>
                            <td class="border px-2 py-1">2023-10-02</td>
                            <td class="border px-2 py-1">Caption for post 2</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
                <div class="mb-4">
                    <label class="block mb-2">Filter by date:</label>
                    <input type="date" class="w-full p-2 border rounded" oninput="filterArchive('xlsx')">
                </div>
                <button class="bg-green-500 text-white px-4 py-2 rounded mb-4" onclick="downloadArchive('xlsx')">Download XLSX</button>
                <button class="bg-green-500 text-white px-4 py-2 rounded mb-4" onclick="downloadArchive('pdf')">Download PDF</button>
                <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded" onclick="toggleArchiveModal()">Close</button>
            </div>
        </div>

        <script>
            function togglePassword() {
                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');

                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');
            }

            function togglePostModal(mediaSrc = '', date = '', caption = '', fileType = '') {
        const modal = document.getElementById('postModal');
        const postMediaContainer = document.getElementById('postMediaContainer');
        const postDate = document.getElementById('postDate');
        const postCaption = document.getElementById('postCaption');

        if (modal.classList.contains('hidden')) {
            postMediaContainer.innerHTML = '';

            if (fileType.includes('video')) {
                const videoElement = document.createElement('video');
                videoElement.src = mediaSrc;
                videoElement.controls = true;
                videoElement.classList.add('w-full', 'h-auto', 'rounded-lg');
                postMediaContainer.appendChild(videoElement);
                videoElement.play();
            } else {
                const imgElement = document.createElement('img');
                imgElement.src = mediaSrc;
                imgElement.alt = 'Post Image';
                imgElement.classList.add('w-full', 'h-auto', 'rounded-lg');
                postMediaContainer.appendChild(imgElement);
            }

            postDate.textContent = date;
            postCaption.textContent = caption;
            modal.classList.remove('hidden');
        } else {
            const videoElement = postMediaContainer.querySelector('video');
            if (videoElement) {
                videoElement.pause();
                videoElement.currentTime = 0;
            }
            modal.classList.add('hidden');
        }
    }

            function toggleUploadModal() {
                const modal = document.getElementById('uploadModal');
                modal.classList.toggle('hidden');
            }

            function unhideEditProfileModal() {
                const modal = document.getElementById('editProfileModal');
                modal.classList.remove('hidden');
            }

            function closeModalOnOutsideClick(event) {
                const modal = document.getElementById('editProfileModal');
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            }

            function toggleSettingsModal() {
                const modal = document.getElementById('settingsModal');
                modal.classList.toggle('hidden');
            }

            function toggleArchiveModal() {
                const modal = document.getElementById('archiveModal');
                modal.classList.toggle('hidden');
            }

            function changeFeedPerLine() {
                const feedPerLine = document.getElementById('feedPerLine').value;
                const posts = document.getElementById('posts');
                posts.className = `grid grid-cols-${feedPerLine} gap-1 mt-1`;
            }

            function downloadArchive(format) {
                const table = document.querySelector('#archiveModal table');
                const rows = Array.from(table.querySelectorAll('tr')).map(row => Array.from(row.querySelectorAll('th, td')).map(cell => {
                    const img = cell.querySelector('img');
                    return img ? img.src : cell.innerText;
                }));

                if (format === 'xlsx') {
                    const ws = XLSX.utils.aoa_to_sheet(rows);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Archive');
                    XLSX.writeFile(wb, 'archive.xlsx');
                } else if (format === 'pdf') {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    doc.text('Archive', 20, 10);

                    let startY = 20;
                    rows.forEach((row, rowIndex) => {
                        row.forEach((cell, colIndex) => {
                            if (colIndex === 0 && rowIndex > 0 && row[colIndex].startsWith('http')) {
                                doc.addImage(row[colIndex], 'JPEG', 20 + colIndex * 50, startY + rowIndex * 10, 10, 10); // Gambar kecil 10x10
                            } else {
                                doc.text(cell, 20 + colIndex * 50, startY + rowIndex * 10);
                            }
                        });
                    });

                    doc.save('archive.pdf');
                }
            }



            function filterArchive() {
                const table = document.querySelector('table');
                const filterInput = document.querySelector('input[type="date"]');
                filterInput.addEventListener('input', () => {
                    const filterValue = filterInput.value;
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach(row => {
                        const dateCell = row.querySelector('td:nth-child(2)');
                        const date = dateCell.textContent;
                        if (date.includes(filterValue)) {
                        row.style.display = '';
                        } else {
                        row.style.display = 'none';
                        }
                    });
                });
            }
        </script>
    </body>
</html>
