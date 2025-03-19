<div class="w-full p-2 bg-white shadow-lg rounded-lg">
    <!-- <table id="dataTable" class="w-full border-collapse">
        <thead>
            <tr class="bg-sky-500 text-white">
                <?php foreach ($columns as $colName): ?>
                    <th class="p-2 text-left"><?= esc($colName) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collection as $item): ?>
                <tr class="border-b hover:bg-blue-100 transition">
                    <?php foreach (array_keys($columns) as $key): ?>
                        <td class="p-2"><?= esc($item[$key] ?? '-') ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> -->

    <thead>
        <tr class="bg-sky-500 text-white">
            <?php foreach ($columns as $colName): ?>
                <th class="p-2 text-left"><?= esc($colName) ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($collection)): ?>
            <?php foreach ($collection as $item): ?>
                <tr class="border-b hover:bg-blue-100 transition">
                    <?php foreach (array_keys($columns) as $key): ?>
                        <td class="p-2"><?= esc($item[$key] ?? '-') ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</div>
