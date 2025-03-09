<x-app-layout>
    <x-row>
        @can('tugas.lihat')
            <x-dashboard-card class="col-lg-6" title="Total Tugas Pending" :value="$tugas_pending" color="secondary"
                icon="fas fa-hourglass-half" />
            <x-dashboard-card class="col-lg-6" title="Total Tugas In Progress" :value="$tugas_in_progress" color="info"
                icon="fas fa-spinner" />
            <x-dashboard-card class="col-lg-6" title="Total Tugas Completed" :value="$tugas_completed" color="success"
                icon="fas fa-check" />
            <x-dashboard-card class="col-lg-6" title="Total Tugas Canceled" :value="$tugas_canceled" color="danger"
                icon="fas fa-times" />
        @endcan
        @can('penugasan.lihat')
            <x-dashboard-card class="col-lg-6" title="Total Penugasan Pending" :value="$penugasan_pending" color="secondary"
                icon="fas fa-hourglass-half" />
            <x-dashboard-card class="col-lg-6" title="Total Penugasan In Progress" :value="$penugasan_in_progress" color="info"
                icon="fas fa-spinner" />
            <x-dashboard-card class="col-lg-6" title="Total Penugasan Completed" :value="$penugasan_completed" color="success"
                icon="fas fa-check" />
            <x-dashboard-card class="col-lg-6" title="Total Penugasan Canceled" :value="$penugasan_canceled" color="danger"
                icon="fas fa-times" />
        @endcan
    </x-row>
</x-app-layout>
