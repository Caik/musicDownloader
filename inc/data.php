<?php if(count($resultados) > 0): ?>
<table class="table table-striped">
	<?php foreach($resultados as $resultado): ?>
		<tr>
			<td>
				<table class="tabela">
					<tr>
						<td colspan="3" style="padding: 10px"><strong class="text-info" style="font-size: 16px"><?= $resultado->getName() ?></strong></td>
					</tr>
					<tr>
						<td><strong>Bitrate: <span name="bitrate_<?= $resultado->getId() ?>" class="text-success"><?= $resultado->getBitrate() ?></span></strong></td>
						<td><strong>Tamanho: <span name="size_<?= $resultado->getId() ?>" class="text-success"><?= $resultado->getSize() ?></span></strong></td>
						<td><strong>Duração: <span class="text-success"><?= $resultado->getDuration() ?></span></strong></td>
					</tr>
				</table>
			</td>
		<?php if(isset($infoFlg) && !$infoFlg): ?>
			<td id="get_<?= $resultado->getId() ?>" align="center" style="vertical-align: middle;">
				<a class="btn btn-warning" href="getDetalhes('<?= $resultado->getId() ?>')">Bitrate/<br />Tamanho</a>
			</td>
		<?php endif; ?>
			<td align="center" style="vertical-align: middle;">
				<a class="btn btn-primary" href="<?= $resultado->getDownloadUrl() ?>">Download</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<?php else: ?>
	<h3 class="text-danger">Nenhum resultado obtido.</h3>
<?php endif; ?>