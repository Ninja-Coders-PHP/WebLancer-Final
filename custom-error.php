<?php

echo("Something went wrong.");?>
<?php if (isset($error)) : ?>
        <p class='error'><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
