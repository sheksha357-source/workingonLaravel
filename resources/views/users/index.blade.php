<!-- resources/views/users/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Users - Hallimart</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }

        h2 { margin-bottom: 20px; color: #333; }

        /* success message */
        .alert {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        /* table */
        table {
            width: 100%;
            background: white;
            border-radius: 8px;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th {
            background: #007bff;
            color: white;
            padding: 14px;
            text-align: left;
        }
        td { padding: 12px 14px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }

        /* button */
        .btn-mail {
            background: #28a745;
            color: white;
            padding: 7px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-mail:hover { background: #218838; }

        .btn-delete {
            background: #dc2626;
            color: white;
            padding: 7px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-delete:hover { background: #b91c1c; }

        .btn-restore {
            background: #2563eb;
            color: white;
            padding: 7px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }
        .btn-restore:hover { background: #1d4ed8; }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .status-active {
            color: #15803d;
            font-weight: 700;
        }

        .status-trashed {
            color: #b91c1c;
            font-weight: 700;
        }

        /* pagination */
        .pagination { margin-top: 20px; display: flex; gap: 5px; }
        .pagination a, .pagination span {
            padding: 8px 14px;
            background: white;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #ddd;
        }
        .pagination .active { background: #007bff; color: white; }
    </style>
</head>
<body>

    <h2>👥 All Users ({{ $users->total() }} total)</h2>

    {{-- success message --}}
    @if(session('success'))
        <div class="alert">✅ {{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    @if($user->trashed())
                        <span class="status-trashed">Trashed</span>
                    @else
                        <span class="status-active">Active</span>
                    @endif
                </td>
                <td>
                    <div class="actions">
                        @if(!$user->trashed())
                            <form method="POST" action="{{ route('users.sendMail', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn-mail">📧 Send Mail</button>
                            </form>

                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('users.restore', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn-restore">Restore</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- pagination --}}
    <div class="pagination">
        {{ $users->links() }}
    </div>

</body>
</html>
