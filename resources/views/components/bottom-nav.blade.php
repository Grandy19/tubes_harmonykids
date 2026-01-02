<div x-data="bottomNav()"
     x-init="init()"
     class="absolute bottom-0 left-0 w-full z-[999] h-[100px] overflow-visible pointer-events-none"
     style="display: none;" 
     x-show="true">

    {{-- 1. SVG OMBAK (Background) --}}
    <svg class="absolute bottom-0 left-0 w-full h-full drop-shadow-[0_-5px_10px_rgba(0,0,0,0.1)]" preserveAspectRatio="none">
        <defs>
            <linearGradient id="mainGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#3577E5;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#0F3974;stop-opacity:1" />
            </linearGradient>
        </defs>
        <path :d="pathString || 'M 0,30 L 1000,30 L 1000,100 L 0,100 Z'" 
              fill="url(#mainGradient)" 
              class="transition-all duration-300 ease-out"></path>
    </svg>

    {{-- 2. LINGKARAN AKTIF (Floating Circle) --}}
    <div class="absolute top-0 transition-all duration-300 ease-out z-20 pointer-events-auto"
         :style="`left: ${activeX - 30}px`">
        <div class="w-[60px] h-[60px] rounded-full bg-[#3577E5] flex items-center justify-center border-2 border-white/20"
             style="box-shadow: 0 4px 25px rgba(110, 193, 228, 0.6);">
            <template x-for="(item, index) in items" :key="index">
                <i x-show="selectedIndex === index"
                   class="text-white text-3xl transition-opacity duration-300"
                   :class="item.icon"></i>
            </template>
        </div>
    </div>

    {{-- 3. IKON TOMBOL (Clickable Area) --}}
    <div class="absolute bottom-0 left-0 w-full h-[80px] flex justify-around items-center z-30 pointer-events-auto">
        <template x-for="(item, index) in items" :key="index">
            <button @click="select(index)"
                    class="w-[60px] h-[60px] flex flex-col justify-center items-center focus:outline-none">

                <div class="pt-[15px] transition-opacity duration-200 relative"
                     :class="selectedIndex === index ? 'opacity-0' : 'opacity-100'">

                    <i :class="[item.icon, 'text-white/80 text-2xl']"></i>

                    {{-- ❤️ BADGE DISUKAI (INDEX 1) --}}
                    @if(isset($likedCount) && $likedCount > 0)
                        <span x-show="index === 1"
                              class="absolute -top-1 -right-1 bg-pink-500 text-white text-[10px]
                                     rounded-full px-1.5 leading-tight">
                            {{ $likedCount }}
                        </span>
                    @endif

                    {{-- 🔔 BADGE NOTIFIKASI (INDEX 2) --}}
                    @if(isset($notificationCount) && $notificationCount > 0)
                        <span x-show="index === 2"
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px]
                                     rounded-full px-1.5 leading-tight">
                            {{ $notificationCount }}
                        </span>
                    @endif

                </div>
            </button>
        </template>
    </div>
</div>

@push('scripts')
<script>
    function bottomNav() {
        return {
            selectedIndex: 0,
            activeX: 0,
            width: 0,
            pathString: '',
            
            items: [
                { icon: 'fas fa-home',  url: "{{ route('wali.home') }}" },
                { icon: 'fas fa-heart', url: "{{ route('wali.liked') ?? '#' }}" },
                { icon: 'fas fa-bell',  url: "{{ route('wali.notifikasi') }}" },
                { icon: 'fas fa-cog',   url: "{{ route('wali.settings') }}" }
            ],

            init() {
                const currentUrl = window.location.href;
                this.items.forEach((item, index) => {
                    if (item.url !== '#' && (currentUrl === item.url || currentUrl.startsWith(item.url))) {
                        this.selectedIndex = index;
                    }
                });

                this.$nextTick(() => {
                    this.updateDimensions();
                    setTimeout(() => this.updateDimensions(), 100);
                    setTimeout(() => this.updateDimensions(), 500);
                });

                window.addEventListener('resize', () => {
                    this.updateDimensions();
                });
            },

            select(index) {
                this.selectedIndex = index;
                this.calculateMetrics();

                const url = this.items[index].url;
                if (url && url !== '#') {
                    setTimeout(() => {
                        window.location.href = url;
                    }, 300);
                }
            },

            updateDimensions() {
                if (this.$el) {
                    this.width = this.$el.offsetWidth; 
                    if(this.width === 0) this.width = window.innerWidth > 420 ? 420 : window.innerWidth;
                    this.calculateMetrics();
                }
            },

            calculateMetrics() {
                if (this.width === 0) return;

                const itemsCount = this.items.length;
                const itemWidth = this.width / itemsCount;
                
                this.activeX = (itemWidth * this.selectedIndex) + (itemWidth / 2);

                const topY = 30;
                const height = 100;
                const curveRadius = 38; 

                let p = `M 0,${topY} `;
                p += `L ${this.activeX - curveRadius - 15},${topY} `; 
                p += `C ${this.activeX - curveRadius},${topY} ${this.activeX - curveRadius},${topY + 40} ${this.activeX},${topY + 40} `;
                p += `C ${this.activeX + curveRadius},${topY + 40} ${this.activeX + curveRadius},${topY} ${this.activeX + curveRadius + 15},${topY} `;
                p += `L ${this.width},${topY} `;
                p += `L ${this.width},${height} L 0,${height} Z`;

                this.pathString = p;
            }
        }
    }
</script>
@endpush
