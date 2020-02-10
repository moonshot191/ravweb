
    <div class="register-newuser">
        <form action="{{route('newuser.store')}}" method="post">
            @csrf
            <div class="form-grup">
                <label for="">Input Name</label>
                <input type="text" placeholder="input name" name="name">
            </div>
            <div class="form-grup">
                <label for="">Input Email</label>
                <input type="text" placeholder="input email" name="email">
            </div>
            <div class="form-grup">

            </div>
            <div class="form-grup">

            </div>
            <div class="form-grup">
                <button type="submit">Register</button>
            </div>



        </form>
    </div>
