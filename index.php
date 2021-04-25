<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курс валют - Главная");
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Курс валют (тенденция)</h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary" id="update_vaulters">Обновить данные</button>
				<button class="btn btn-sm btn-outline-secondary" id="load_vaulters">Подгрузить данные</button>
			</div>
		</div>
	</div>
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item" role="presentation">
			<button class="nav-link active" id="pills-fresh-tab" data-bs-toggle="pill" data-bs-target="#pills-fresh" 
			type="button" role="tab" aria-controls="pills-fresh" aria-selected="true">Свежие данные</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="pills-old-tab" data-bs-toggle="pill" data-bs-target="#pills-old" 
			type="button" role="tab" aria-controls="pills-old" aria-selected="false">Архив</button>
		</li>
	</ul>

	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-fresh" role="tabpanel" aria-labelledby="pills-fresh-tab">
			<canvas class="my-4 chartjs-render-monitor" id="myChartFresh" width="1538" height="649" style="display: block; width: 1538px; height: 649px;"></canvas>
			<h2>История операция (история загрузки)</h2>
			<div class="table-responsive">
				<table class="table table-striped table-sm">
					<thead>
					<tr>
						<th>#</th>
						<th>Курс на момент загрузки</th>
						<th>Наименование сервиса</th>
						<th>Дата</th>
						<th>Время</th>
						<th>Статус</th>
					</tr>
					</thead>
					<tbody id="vaulter-table-fresh">

					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane fade" id="pills-old" role="tabpanel" aria-labelledby="pills-old-tab">
			<canvas class="my-4 chartjs-render-monitor" id="myChartOld" width="1538" height="649" style="display: block; width: 1538px; height: 649px;"></canvas>
			<h2>История операция (история загрузки)</h2>
			<div class="table-responsive">
				<table class="table table-striped table-sm">
					<thead>
					<tr>
						<th>#</th>
						<th>Курс на момент загрузки</th>
						<th>Наименование сервиса</th>
						<th>Дата</th>
						<th>Время</th>
						<th>Статус</th>
					</tr>
					</thead>
					<tbody id="vaulter-table-old">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>