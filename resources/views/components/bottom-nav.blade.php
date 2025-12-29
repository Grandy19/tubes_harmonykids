<div x-data="bottomNav()" x-init="init()" class="absolute bottom-0 left-0 w-full z-50 h-[100px] overflow-visible">

    <svg class="absolute bottom-0 left-0 w-full h-full drop-shadow-[0_-5px_10px_rgba(0,0,0,0.1)] pointer-events-none" preserveAspectRatio="none">
        <defs>
            <linearGradient id="mainGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#3577E5;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#0F3974;stop-opacity:1" />
            </linearGradient>
        </defs>
        <path :d="pathString" fill="url(#mainGradient)" class="transition-all duration-300 ease-out"></path>
    </svg>

    <div class="absolute top-0 transition-all duration-300 ease-out z-20"
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

    <div class="absolute bottom-0 left-0 w-full h-[80px] flex justify-around items-center z-30">
        <template x-for="(item, index) in items" :key="index">
            <button @click="select(index)" class="w-[60px] h-[60px] flex flex-col justify-center items-center focus:outline-none">
                <div class="pt-[15px] transition-opacity duration-200"
                     :class="selectedIndex === index ? 'opacity-0' : 'opacity-100'">
                     <i :class="[item.icon, 'text-white/80 text-2xl']"></i>
                </div>
            </button>
        </template>
    </div>
</div>

<script>
    function bottomNav() {
        return {
            selectedIndex: 0,
            activeX: 0,
            width: 0,
            pathString: '',
            
            items: [
                { icon: 'fas fa-home' },
                { icon: 'fas fa-clock' },
                { icon: 'fas fa-bell' },
                { icon: 'fas fa-cog' }
            ],

            init() {
                // Trik agar Alpine membaca lebar elemen container ($el)
                this.$nextTick(() => {
                    this.updateDimensions();
                });

                window.addEventListener('resize', () => {
                    this.updateDimensions();
                });
            },

            select(index) {
                this.selectedIndex = index;
                this.calculateMetrics();
            },

            updateDimensions() {
                // Mengambil lebar elemen container navbar, bukan window
                if (this.$el) {
                    this.width = this.$el.offsetWidth; 
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