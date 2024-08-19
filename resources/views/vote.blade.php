<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Masukkan No Kad Pengenalan Anda untuk Mengundi</h3>
        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form id="ic-form" method="POST" action="{{ route('check-vote') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="ic_number">No Kad Pengenalan:</label>
                <input type="text" class="form-control" id="ic_number" name="ic_number" placeholder="No Kad Pengenalan tanpa (-) " required>
            </div>
            <button type="submit" class="btn btn-primary">Semak Kelayakan</button>
        </form>
    </div>

    <!-- Modal for Voting -->
    <div class="modal fade" id="voteModal" tabindex="-1" role="dialog" aria-labelledby="voteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voteModalLabel">Undi Sekarang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="vote-form" method="POST" action="{{ route('submit-vote') }}">
                        @csrf
                        <input type="hidden" id="hidden_ic" name="ic_number">
                        <div class="form-group">
                            <div style="text-align: justify">
                                <p>Mengambil kira kedudukan semasa Syarikat yang kini berada dalam prestasi cemerlang, pihak Syarikat berhasrat untuk melaksanakan Pelan Keluar (Exit Plan) seperti yang diperuntukkan dalam Memorandum Maklumat dan Perjanjian Saham Keutamaan yang telah dipersetujui antara Syarikat dan para Pemegang Saham Keutamaan. 
                                    </p>
                                <p>Sehubungan itu, adakah anda BERSETUJU dengan cadangan QEW GROUP BERHAD untuk MEMBELI SEMULA SAHAM KEUTAMAAN anda?</p>
                            </div>
                            <label for="vote" class="text-muted">Pilih pilihan anda</label>
                            <select class="form-control" id="vote" name="vote" required>
                                <option value="YA">YA, saya bersetuju.</option>
                                <option value="TIDAK">TIDAK, saya tidak bersetuju.</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Hantar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Handle the form submission
        document.getElementById('ic-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let icNumber = document.getElementById('ic_number').value;

            fetch('{{ route('check-vote') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ic_number: icNumber })
            })
            .then(response => response.json())
            .then(data => {
                if (data.can_vote) {
                    // IC number is eligible for voting
                    document.getElementById('hidden_ic').value = data.ic_number;
                    $('#voteModal').modal('show');
                } else {
                    // IC number is not eligible
                    alert('Anda tidak boleh mengundi. No Kad Pengenalan anda tidak layak.');
                }
            });
        });
    </script>
</body>
</html>
