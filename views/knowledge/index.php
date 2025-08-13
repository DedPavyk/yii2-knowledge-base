<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile('@web/css/styles.css');

$this->title = 'База знаний';
?>
<div class="knowledge-index">
    <table class="knowledge-table">
        <thead>
            <tr>
                <th class="header">Тема</th>
                <th class="header">Подтема</th>
                <th class="header">Содержимое</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="topics-column">
                    <div id="topics">
                    <?php foreach ($data as $index => $topic): ?>
                        <div class="topic" data-id="<?= $topic['id'] ?>"
                        <?= ($index > 0) ? 'style="border-top: 1px solid #eee;"' : '' ?>>
                    <?= Html::encode($topic['name']) ?>
            </div>
<?php endforeach; ?>
                    </div>
                </td>
                <td class="subtopics-column">
                    <div id="subtopics">
                        <?php
                        $firstTopic = reset($data);
                        foreach ($firstTopic['subtopics'] as $subtopic): ?>
                            <div class="subtopic" data-id="<?= $subtopic['id'] ?>">
                                <?= Html::encode($subtopic['title']) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </td>
                <td class="content-column">
                    <div id="content">
                        <?php
                        $firstSubtopic = reset($firstTopic['subtopics']);
                        echo $this->render('_content', ['content' => $firstSubtopic]);
                        ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php
// Генерируем URL заранее
$urlGetSubtopics = Url::to(['/knowledge/get-subtopics']);
$urlGetContent = Url::to(['/knowledge/get-content']);

$js = <<<JS
$(document).ready(function() {
    // Инициализация
    $('#topics .topic[data-id="$initialTopicId"]').addClass('active');
    $('#subtopics .subtopic[data-id="$initialSubtopicId"]').addClass('active');

    // Обработчик клика на тему
    $('#topics').on('click', '.topic', function() {
        const topicId = $(this).data('id');
        
        // Подсветка выбранной темы
        $('#topics .topic').removeClass('active');
        $(this).addClass('active');
        
        // Загрузка подтем
        $.get('$urlGetSubtopics', {topicId: topicId})
            .done(function(data) {
                $('#subtopics').html(data);
                
                // Автовыбор первой подтемы
                const firstSubtopic = $('#subtopics .subtopic:first');
                if (firstSubtopic.length) {
                    const subtopicId = firstSubtopic.data('id');
                    firstSubtopic.addClass('active');
                    
                    // Загрузка контента
                    $.get('$urlGetContent', {subtopicId: subtopicId})
                        .done(function(content) {
                            $('#content').html(content);
                        });
                }
            });
    });

    // Обработчик клика на подтему
    $('#subtopics').on('click', '.subtopic', function() {
        const subtopicId = $(this).data('id');
        
        // Подсветка выбранной подтемы
        $('#subtopics .subtopic').removeClass('active');
        $(this).addClass('active');
        
        // Загрузка контента
        $.get('$urlGetContent', {subtopicId: subtopicId})
            .done(function(content) {
                $('#content').html(content);
            });
    });
});
JS;
$this->registerJs($js);
?>