<?php include_once "../../header.php"; ?>

<div class="hero min-h-screen" style="background-image: url(https://api.lorem.space/image/fashion?w=1000&h=800);">
  <div class="hero-overlay bg-opacity-60"></div>
  <div class="hero-content text-center text-neutral-content">
    <div class="max-w-md">
      <h1 class="mb-5 text-5xl font-bold">Welcome to your Dashboard</h1>
      <p class="mb-5"> Your email is: <p><?= $user["email"] ?></p></p>
    </div>
  </div>
</div>

<?php include_once "../../footer.php"; ?>
