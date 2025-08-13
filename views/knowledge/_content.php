<?php
use yii\helpers\Html;

if (isset($subtopics)): ?>
    <?php foreach ($subtopics as $subtopic): ?>
        <div class="subtopic" data-id="<?= $subtopic['id'] ?>">
            <?= Html::encode($subtopic['title']) ?>
        </div>
    <?php endforeach; ?>
<?php elseif (isset($content)): ?>
    <div class="content-item">
        <h3><?= Html::encode($content['title']) ?></h3>
        <p><?= Html::encode($content['content']) ?></p>
        <?php if (!empty($content['highlights'])): ?>
            <ul>
                <?php foreach ($content['highlights'] as $highlight): ?>
                    <li><?= Html::encode($highlight) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>