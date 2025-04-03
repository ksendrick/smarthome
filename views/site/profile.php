<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Smart Home';
?>

<div class="d-flex flex-column">
    <div class="profile_index container mt-2">

        <div class="profile_text">
            <h2>Базовые сценарии</h2>
            <p>Используйте предложенный вариант или настройте под себя</p>
        </div>

        <div class="d-flex flex-column">
            <?php foreach ($scenario as $item): ?>
                <div class="d-flex justify-content-end align-items-end">
                    <a href="<?= Url::toRoute(['scenario-user/create', 'scenarioId' => $item->id]) ?>"
                       class="btn btn-outline-dark"><?= $item->name ?></a>
                </div>
            <?php endforeach; ?>
            <div class="scenario_img mt-3">
                <img src="/img/rendering-smart-home-device.jpg" alt="Фото для профиля" class="mute">
                <img src="/img/rendering-smart-home-device%20(1).jpg" alt="Фото для профиля" class="mute">
                <img src="/img/desk-lamp-with-minimalist-monochrome-background.jpg" alt="Фото для профиля"
                     class="mute">
            </div>
        </div>
    </div>
</div>

<div class="profile_device container mt-5">
    <div class="profile_scenario mb-4">
        <?php if (!empty($scenario_user)): ?>
            <h2>Сценарии</h2>
            <?php foreach ($scenario_user as $item): ?>
                <div class="scenario-card"
                     style="width: 100%;border:1px solid #e6e5e5;height: auto;padding: 20px 10px;display: flex;align-items: flex-start;flex-direction: column;">
                    <h5><?= $item->name ?></h5>
                    <a href="<?= Url::toRoute(['scenario-user/update', 'id' => $item->id]); ?>">Редактировать
                        сценарий</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h5>Нет сохраненных сценариев</h5>
        <?php endif; ?>
    </div>
    <div class="profile_device-user">
        <h2>Подключённые устройства</h2>
        <div class="d-flex flex-wrap justify-content-around">
            <?php foreach ($device_user as $item): ?>
                <div class="device-card" style="background-color: #f3f2f2;">
                    <div class="image-container">
                        <img src="/<?= $item->device->img ?>" alt="<?= htmlspecialchars($item->device->name) ?>"
                             class="device-image">
                    </div>
                    <div class="d-flex align-items-center justify-content-center flex-column p-4">
                        <h5><?= htmlspecialchars($item->device->name) ?></h5>
                        <a href="<?= Url::toRoute(['site/device', 'id' => $item->id]); ?>"
                           class="btn btn-primary">Просмотреть</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="pagination-container">
            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]); ?>
        </div>
    </div>
</div>


<div class="group-banner">
    <div class="group-text">
        <div class="text_2">
            <h2>Группы устройств</h2>
            <p>Управление группой устройств позволяет значительно упростить и ускорить процессы администрирования,
                обеспечивая централизованный контроль и координацию.</p>
            <a href="<?= Url::toRoute(['group/create']) ?>" class="btn btn-outline-light">Создать группу</a>
        </div>
    </div>
    <?php if (!empty($group)): ?>
        <div class="group_profile" style="background-image: url('/<?= $group[0]->groupImg->img ?>');">
            <div class="group-card">
                <h3 class="group-name"><?= $group[0]->name ?></h3>
                <a href="<?= Url::toRoute(['group/index', 'id' => $group[0]->id]) ?>" class="group-name">Подробнее</a>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="other_group">
    <?php for ($index = 1; $index < count($group); $index++): ?>
        <div class="group-banner_second">
            <div class="group_profile_other" style="background-image: url('/<?= $group[$index]->groupImg->img ?>');">
                <div class="group-card-other">
                    <div class="text_2">
                        <h3 class="group-name"><?= $group[$index]->name ?></h3>
                        <a href="<?= Url::toRoute(['group/index', 'id' => $group[$index]->id]) ?>" class="group-name">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</div>

