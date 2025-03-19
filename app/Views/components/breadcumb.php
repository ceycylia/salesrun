<?php if (!empty($breadcrumb) && is_array($breadcrumb)): ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-2 rounded">
        <?php foreach ($breadcrumb as $key => $item): ?>
            <?php if ($key === array_key_last($breadcrumb)): ?>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($item['label']) ?></li>
            <?php else: ?>
                <li class="breadcrumb-item">
                    <a href="<?= base_url($item['url']) ?>"><?= esc($item['label']) ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
