<html>
<body>
<h2>Users</h2>
<p>Count: {{count($users)}}</p>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        </tr>
    @endforeach

</table>

<h2>Redis keys</h2>

<table border="1">
    <tr>
        <th>key</th>
    </tr>
    @foreach ($redisKeys as $redisKey)
        <tr>
            <td>{{$redisKey}}</td>
        </tr>
    @endforeach

</table>
<h2>Create User</h2>
<form action="{{ url('users') }}" method="post">
    @csrf {{-- CSRF保護 --}}
    @method('POST') {{-- 疑似フォームメソッド --}}
    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" required autofocus>
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Create</button>
</form>
</body>
</html>
