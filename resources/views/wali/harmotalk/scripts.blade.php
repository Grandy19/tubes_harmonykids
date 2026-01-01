@push('scripts')
<script>
    // --- UTILS ---
    function escapeHtml(str) {
        return (str || '').replace(/[&<>"']/g, function(m) {
            return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[m]);
        });
    }

    // --- SORT MENU ---
    function toggleSortMenu(e) {
        e.preventDefault(); e.stopPropagation();
        document.getElementById('sortMenu').classList.toggle('open');
    }
    document.addEventListener('click', function() {
        const menu = document.getElementById('sortMenu');
        if (menu) menu.classList.remove('open');
    });

    // --- LIKE AJAX ---
    document.addEventListener('click', async function(e) {
        const btn = e.target.closest('.js-like-btn');
        if (!btn) return;

        const form = btn.closest('form.like-form');
        const token = form.querySelector('input[name="_token"]').value;
        const url = btn.dataset.url;
        const countEl = document.getElementById('like-count-' + btn.dataset.postId);

        // UI Optimis
        const oldLiked = btn.dataset.liked === '1';
        const oldCount = parseInt(countEl.textContent || '0', 10);
        const newLiked = !oldLiked;

        btn.dataset.liked = newLiked ? '1' : '0';
        btn.style.color = newLiked ? '#3577E5' : '#64748b'; // Biru jika like, Abu jika unlike
        countEl.textContent = newLiked ? (oldCount + 1) : Math.max(0, oldCount - 1);

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!res.ok) throw new Error();
        } catch (err) {
            // Rollback jika gagal
            btn.dataset.liked = oldLiked ? '1' : '0';
            btn.style.color = oldLiked ? '#3577E5' : '#64748b';
            countEl.textContent = oldCount;
        }
    });

    // --- KOMENTAR SYSTEM ---
    function toggleComments(id) {
        const box = document.getElementById('comment-box-' + id);
        const list = document.getElementById('comment-list-' + id);
        
        box.classList.toggle('active');
        if (!box.classList.contains('active') || list.dataset.loaded) return;

        list.innerHTML = '<div style="font-size:12px;color:#94a3b8;padding:5px 0;">Memuat...</div>';

        fetch(`/wali/harmotalk/${id}/comments`, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
        .then(r => r.json())
        .then(data => {
            list.innerHTML = '';
            if (!data || data.length === 0) list.innerHTML = '<div style="font-size:12px;color:#94a3b8;padding:5px 0;">Belum ada komentar</div>';
            else {
                data.forEach(c => {
                    list.innerHTML += `<div class="comment-item"><b>${escapeHtml(c.name)}</b>: ${escapeHtml(c.content)}<div style="font-size:10px;color:#94a3b8;">${escapeHtml(c.time)}</div></div>`;
                });
            }
            list.dataset.loaded = true;
        });
    }

    // KIRIM KOMENTAR
    document.addEventListener('submit', async function(e) {
        const form = e.target.closest('.comment-form');
        if (!form) return;
        e.preventDefault();

        const url = form.dataset.url;
        const token = form.querySelector('input[name="_token"]').value;
        const postId = form.dataset.postId;
        const input = form.querySelector('input[name="comment"]');
        const text = (input.value || '').trim();
        if (!text) return;

        input.value = ''; // Clear input

        // Buka box komentar & load jika belum
        const box = document.getElementById('comment-box-' + postId);
        const list = document.getElementById('comment-list-' + postId);
        box?.classList.add('active');
        if (list && !list.dataset.loaded) toggleComments(parseInt(postId));

        // Tampilkan komentar sementara (Optimistic)
        const tempId = 'temp-' + Date.now();
        if(list.innerText.includes('Belum ada')) list.innerHTML = '';
        list.insertAdjacentHTML('afterbegin', `<div class="comment-item" id="${tempId}" style="opacity:0.6;"><b>Anda</b>: ${escapeHtml(text)}<div style="font-size:10px;color:#94a3b8;">Mengirim...</div></div>`);

        try {
            const res = await fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token, 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ comment: text })
            });
            if (!res.ok) throw new Error();
            
            const data = await res.json();
            
            // Update UI dengan data asli
            document.getElementById('comment-count-' + postId).textContent = data.comments_count;
            const tempEl = document.getElementById(tempId);
            if(tempEl) {
                tempEl.style.opacity = '1';
                tempEl.innerHTML = `<b>${escapeHtml(data.comment.name)}</b>: ${escapeHtml(data.comment.content)}<div style="font-size:10px;color:#94a3b8;">${escapeHtml(data.comment.time)}</div>`;
            }
        } catch (err) {
            document.getElementById(tempId)?.remove();
            alert('Gagal mengirim komentar.');
            input.value = text;
        }
    });
</script>
@endpush