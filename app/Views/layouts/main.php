<!DOCTYPE html>
<html lang="en">

<?= $this->include('layouts/assets') ?>

<body class="bg-light min-h-screen flex flex-col antialiased">
  <!-- Tambahkan Navbar -->

  <?= $this->include('layouts/navbar') ?>

  <!-- Content Utama -->
  <main class="container mx-auto p-4 w-full space-y-4  flex-1">
    <?= $this->renderSection('content') ?>
  </main>

  <!-- Bagian Footer -->
  <?= $this->include('layouts/footer') ?>


  <!-- Bagian script js -->
  <?= $this->renderSection('script') ?>

</body>


</html>