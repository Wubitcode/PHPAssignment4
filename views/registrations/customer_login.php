<?php include __DIR__ . '/../header.php'; ?>


<div class="container mt-4">
    <h2>Customer Login</h2>
    <p>You must login before you can register a product.</p>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="../../controllers/project_controller.php" method="post" class="w-50">
        <input type="hidden" name="action" value="login_customer">

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control">
        </div>

        <button class="btn btn-primary">Login</button>
    </form>
</div>

<?php include __DIR__ . '/../footer.php'; ?>

