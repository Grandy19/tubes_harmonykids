{{-- WRAPPER UTAMA --}}
<div class="page-container">

    {{-- LAYER 1: HEADER --}}
    <div class="header-layer">
        <x-custom-header title="HarmoTalk" />
    </div>

    {{-- LAYER 2: CONTENT (SCROLLABLE) --}}
    <div class="content-scroll">

        {{-- A. TABS & BANNER --}}
        <div class="floating-area">
            {{-- Tabs & Sort --}}
            <div class="tabs-row">
                {{-- Tab: Semua --}}
                <a class="tab-pill {{ $tab === 'all' ? 'active' : '' }}" 
                   href="{{ route('wali.harmotalk', ['tab' => 'all', 'sort' => $sort]) }}">
                   Semua
                </a>

                {{-- Tab: Post Saya --}}
                <a class="tab-pill {{ $tab === 'mine' ? 'active' : '' }}" 
                   href="{{ route('wali.harmotalk', ['tab' => 'mine', 'sort' => $sort]) }}">
                   Post
                </a>
                
                {{-- Sort Dropdown (Posisi Kanan) --}}
<div class="sort-dd">
    <button type="button" class="tab-pill sort sort-blue"
            onclick="toggleSortMenu(event)">
        <span class="sort-text">
            {{ $sort === 'popular' ? 'Terpopuler' : 'Terbaru' }}
        </span>
        <i class="fa-solid fa-chevron-down sort-icon"></i>
    </button>
                    
                    {{-- Menu List --}}
                    <div class="sort-menu" id="sortMenu">
                        <a class="sort-item {{ $sort === 'latest' ? 'active' : '' }}" 
                           href="{{ route('wali.harmotalk', ['tab' => $tab, 'sort' => 'latest']) }}">
                           <i class="fa-solid fa-clock-rotate-left" style="margin-right: 8px;"></i> Terbaru
                        </a>
                        <a class="sort-item {{ $sort === 'popular' ? 'active' : '' }}" 
                           href="{{ route('wali.harmotalk', ['tab' => $tab, 'sort' => 'popular']) }}">
                           <i class="fa-solid fa-fire" style="margin-right: 8px;"></i> Terpopuler
                        </a>
                    </div>
                </div>
            </div>

            {{-- Banner CTA --}}
            <div class="cta-banner-figma">
                <div style="flex: 1; padding-right: 15px; position: relative; z-index: 2;">
                    <div style="font-weight:800; font-size: 15px; line-height: 1.4; margin-bottom: 5px;">
                        “Buat postingan bersama si kecil dengan klik disini!”
                    </div>
                    <a href="{{ route('wali.harmotalk.create') }}" class="cta-white-btn-figma">
                        Klik Disini
                    </a>
                </div>
                <img src="{{ asset('assets/images/ortuPost.png') }}" style="height: 120px; object-fit: contain; position: relative; z-index: 2;" alt="ortuPost">
            </div>
        </div>

        {{-- B. LIST POSTINGAN --}}
        <div id="posts-container">
            @forelse($posts as $post)
                @php
                    $nama = data_get($post, 'wali.name') ?? 'User';
                    $img = $post->image ? asset('storage/' . str_replace('public/', '', $post->image)) : null;
                    $isLiked = in_array($post->id, $likedPostIds, true);

                    // Avatar Logic
                    $photoPath = data_get($post, 'wali.photo') ?? data_get($post, 'wali.image'); 
                    if ($photoPath) {
                        $avatar = asset('storage/' . $photoPath);
                    } else {
                        $avatar = "https://ui-avatars.com/api/?name=".urlencode($nama)."&background=EAF2FF&color=3577E5&bold=true";
                    }
                @endphp

                <div class="post" id="post-{{ $post->id }}">
                    {{-- Header --}}
                    <div class="post-head">
                        <div class="ava" style="background-image: url('{{ $avatar }}');"></div>
                        <div style="flex: 1;">
                            <div class="name">{{ $nama }}</div>
                            <div class="time">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>

                    {{-- Image --}}
                    @if($img)
                        <div class="post-img-frame">
                            <img src="{{ $img }}" alt="post image" loading="lazy">
                        </div>
                    @endif

                    {{-- Text --}}
                    <div class="content">{!! nl2br(e($post->content)) !!}</div>

                    {{-- Footer --}}
                    <div class="foot">
                        <form class="like-form" style="display:inline;">
                            @csrf
                            <button type="button" class="like-btn js-like-btn"
                                    data-liked="{{ $isLiked ? '1' : '0' }}"
                                    data-post-id="{{ $post->id }}"
                                    data-url="{{ route('wali.harmotalk.like', $post->id) }}"
                                    style="color: {{ $isLiked ? '#3577E5' : '#64748B' }}">
                                <i class="{{ $isLiked ? 'fa-solid' : 'fa-regular' }} fa-heart" style="font-size: 18px;"></i>
                                <span class="js-like-count" id="like-count-{{ $post->id }}">{{ $post->likes }}</span>
                            </button>
                        </form>

                        <span class="comment-btn" onclick="toggleComments({{ $post->id }})">
                            <i class="fa-regular fa-comment" style="font-size: 18px;"></i>
                            <span class="js-comment-count" id="comment-count-{{ $post->id }}">{{ $post->comments_count }}</span>
                        </span>
                    </div>

                    {{-- Comment Section --}}
                    <div id="comment-box-{{ $post->id }}" class="comment-box">
                        <div id="comment-list-{{ $post->id }}"></div>
                        
                        <form method="POST" class="comment-form"
                              data-post-id="{{ $post->id }}"
                              data-url="{{ route('wali.harmotalk.comment', $post->id) }}">
                            @csrf
                            <input name="comment" class="comment-input" placeholder="Tulis komentar..." required autocomplete="off">
                            <button type="submit" class="comment-send">
                                <i class="fa-solid fa-paper-plane" style="font-size: 14px;"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 60px 24px; color: #94A3B8;">
                    <img src="{{ asset('assets/images/empty-post.png') }}" onerror="this.style.display='none'" style="width: 140px; margin-bottom: 24px; opacity: 0.8;">
                    <p style="font-size: 15px; font-weight: 600; margin-bottom: 15px;">Belum ada postingan saat ini.</p>
                    <a href="{{ route('wali.harmotalk.create') }}" style="color: #3577E5; font-weight: 800; font-size: 14px; text-decoration: none; border-bottom: 2px solid #3577E5;">
                        Buat Postingan Pertama
                    </a>
                </div>
            @endforelse
        </div>
        
    </div>
</div>