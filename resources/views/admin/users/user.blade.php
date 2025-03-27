@extends('components.app', ['title' => 'Data User'])

@section('content')
    <div class="card shadow mb-5 bg-body rounded">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title fw-bold">Kelola User</h4>
                <a href="javascript:void(0)" class="btn btn-primary" data-bs-target="#modalForm" data-bs-toggle="modal">Tambah
                    Data</a>
            </div>

            <div class="mb-3 d-flex justify-content-start">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari user...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telephone }}</td>
                                <td>{{ Str::upper($user->role) }}</td>
                                <td>
                                    <button class="btn btn-sm status-btn {{ $user->status ? 'btn-success' : 'btn-danger' }}"
                                        data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                                        {{ $user->status ? 'Aktif' : 'Tidak Aktif' }}
                                    </button>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-btn"
                                        data-id="{{ $user->id }}">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Form User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST" id="form-user">
                    @csrf
                    <div id="method">
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="form-control" id="name" name="name">
                            <small class="text-danger error-text name_error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <small class="text-danger error-text email_error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone">
                            <small class="text-danger error-text telpehon_error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="nasabah">Nasabah</option>
                                <option value="marketing">Marketing</option>
                                <option value="admin">Admin</option>
                            </select>
                            <small class="text-danger error-text role_error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusActive"
                                        value="1">
                                    <label class="form-check-label" for="statusActive">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="statusInactive"
                                        value="0">
                                    <label class="form-check-label" for="statusInactive">Tidak Aktif</label>
                                </div>
                            </div>
                            <small class="text-danger error-text status_error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                            <small class="text-danger error-text password_error"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-accept">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let timeoutId;
            const modal = $('#modalForm');
            const form = $('#form-user');

            $('#searchInput').on('keyup', function() {
                clearTimeout(timeoutId);

                timeoutId = setTimeout(() => {
                    const searchValue = $(this).val();
                    window.location.href = `${window.location.pathname}?search=${searchValue}`;
                }, 500);
            });

            // Set search input value from URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search')) {
                $('#searchInput').val(urlParams.get('search'));
            }

            // Reset Form
            modal.on('hidden.bs.modal', function() {
                form.trigger('reset');
                form.attr('action', "{{ route('admin.users.store') }}");
                $('#method').html('');
            });

            // Edit button handler
            $('.edit-btn').on('click', function() {
                const id = $(this).data('id');
                const url = `{{ route('admin.users.edit', ':id') }}`.replace(':id', id);

                $.get(url, function(data) {
                    modal.find('.modal-title').text('Edit User');
                    form.attr('action', "{{ route('admin.users.update', ':id') }}".replace(':id',
                        id));
                    $('#method').html('@method('PUT')');

                    form.find('[name="id"]').val(data.id);
                    form.find('[name="name"]').val(data.name);
                    form.find('[name="email"]').val(data.email);
                    form.find('[name="telephone"]').val(data.telephone);
                    form.find('[name="role"]').val(data.role);
                    form.find(`#status${data.status ? 'Active' : 'Inactive'}`).prop('checked',
                        true);

                    modal.modal('show');
                });
            });

            // Delete confirmation
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                const deleteForm = $(this).closest('form');

                swal({
                    title: "Are you sure?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            visible: true,
                            text: "Batal",
                            className: "btn btn-danger",
                        },
                        confirm: {
                            text: "Hapus",
                            className: "btn btn-success",
                        },
                    },
                }).then((willDelete) => {
                    if (willDelete) {
                        deleteForm.submit();
                    } else {
                        swal("Hapus data dibatalkan!", {
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                    }
                });
            });

            // Status toggle handler
            $('.status-btn').on('click', function() {
                const btn = $(this);
                const id = btn.data('id');
                const url = `{{ route('admin.users.status', ':id') }}`.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.status) {
                                btn.removeClass('btn-danger').addClass('btn-success');
                                btn.text('Aktif');
                            } else {
                                btn.removeClass('btn-success').addClass('btn-danger');
                                btn.text('Tidak Aktif');
                            }
                            btn.data('status', response.status);
                        }
                    }
                });
            });
        });
    </script>
@endpush
