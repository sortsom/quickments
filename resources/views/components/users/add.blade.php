<form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>User Account</label>
    <select name="user_id" required>
        <option value="">-- Select User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} — {{ $user->email }}</option>
        @endforeach
    </select>

    <label>Name</label>
    <input type="text" name="name">

    <label>Name KH</label>
    <input type="text" name="name_kh">

    <label>Gender</label>
    <select name="gender">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <label>Position</label>
    <input type="text" name="position">

    <label>Photo</label>
    <input type="file" name="photo">

    <button type="submit">Save</button>
</form>
