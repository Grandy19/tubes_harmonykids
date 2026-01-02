<div class="mt-3">

    @forelse($notifikasi as $item)
        <div class="notif-card mb-3">
            <div class="card-body d-flex gap-3 p-3">

                {{-- ICON STATUS --}}
                <div class="notif-icon
                    @if($item->status === 'pending') notif-pending
                    @elseif($item->status === 'verified') notif-verified
                    @elseif($item->status === 'accepted') notif-accepted
                    @elseif($item->status === 'rejected') notif-rejected
                    @endif
                ">
                    @if($item->status === 'pending')
                        <i class="fa-solid fa-clock"></i>
                    @elseif($item->status === 'verified')
                        <i class="fa-solid fa-receipt"></i>
                    @elseif($item->status === 'accepted')
                        <i class="fa-solid fa-circle-check"></i>
                    @elseif($item->status === 'rejected')
                        <i class="fa-solid fa-circle-xmark"></i>
                    @endif
                </div>

                {{-- CONTENT --}}
                <div class="flex-grow-1">

                    <div class="notif-title">
                        {{ $item->instansi->nama }}
                    </div>

                    <div class="notif-desc">
                        @if($item->status === 'pending')
                            Pendaftaran anak <strong>{{ $item->nama_anak }}</strong>
                            berhasil dikirim dan sedang menunggu konfirmasi.
                        @elseif($item->status === 'verified')
                            Pembayaran pendaftaran telah diverifikasi oleh pengelola.
                        @elseif($item->status === 'accepted')
                            🎉 Selamat! Pendaftaran anak Anda <strong>diterima</strong>.
                        @elseif($item->status === 'rejected')
                            Mohon maaf, pendaftaran anak Anda <strong>ditolak</strong>.
                        @endif
                    </div>

                    <div class="notif-time">
                        {{ $item->updated_at->diffForHumans() }}
                    </div>

                </div>

            </div>
        </div>
    @empty
        <div class="notif-empty">
            <i class="fa-regular fa-bell-slash"></i>
            <p>Belum ada notifikasi</p>
        </div>
    @endforelse

</div>
