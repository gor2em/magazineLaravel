@include('admin.header')

@include("admin.sidebar")

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $page_title }}</h2>
                <a href="{{ url('register') }}">
                    <button class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                        Add User
                    </button>
                </a>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rows)
                        @foreach ($rows as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td><?= $row->email ?></td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    <a href="{{ url('admin/users/edit/' . $row->id) }}">
                                        <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</button>
                                    </a>
                                    <a href="{{ url('admin/users/delete/' . $row->id) }}">
                                        <button class="btn btn-sm btn-danger"><i
                                                class="fa fa-times"></i>Delete</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /. ROW  -->
        <hr />

        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>

@include('admin.footer')
