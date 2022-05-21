<?php

/**
 * @var $message string|\Services\Message\Message
 */
if ($message instanceof \MyProject\Services\Message\Message) {
  $type = $message->getType();
  $text = $message->getText();
?>
  <div class="notice notice_<?= $type ?>">
    <?= $text ?>
  </div>
<?php } ?>