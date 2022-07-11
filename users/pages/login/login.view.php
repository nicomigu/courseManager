<?php include_once "../../header.php"; ?>

<div class="hero min-h-screen bg-base-200">

  <div class="hero-content flex-col lg:flex-row-reverse">
    <div class="text-center lg:text-left">
      <h1 class="text-5xl font-bold">Welcome back.</h1>
      <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
    </div>
    <form method="post" action="loginHandler.php" class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
      <div class="card-body">
        <div class="form-control">
          <label class="label">
            <span class="label-text">Email</span>
          </label>
          <input type="text" placeholder="email" name="email" class="input input-bordered" />
        </div>
        <div class="form-control">
          <label class="label">
            <span class="label-text">Password</span>
          </label>
          <input type="password" placeholder="password" name="password" class="input input-bordered" />
        </div>
        <?= $errors ?>
        <div class="form-control mt-6">
          <button type="submit" style="color:white;background-color: #570DF8;" class="btn btn-primary">Login</button>
        </div>
      </div>
</form>
  </div>
</div>

<?php include_once "../../footer.php"; ?>