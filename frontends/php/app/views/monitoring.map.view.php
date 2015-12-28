<?php
/*
** Zabbix
** Copyright (C) 2001-2015 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
**/


$actionMap = getActionMapBySysmap($data['map'], ['severity_min' => $data['severity_min']]);
$imgMap = (new CImg('map.php?sysmapid='.$data['map']['sysmapid'].'&severity_min='.$data['severity_min']))
	->setMap($actionMap->getName());

(new CWidget())
	->setTitle(_('Maps'))
	->setControls(
		(new CForm('get'))
			->cleanItems()
			->addVar('action', 'map.view')
			->addVar('sysmapid', $data['map']['sysmapid'])
			->addVar('fullscreen', $data['fullscreen'])
			->addItem(
				(new CList())
					->addItem([_('Minimum severity'), SPACE, $data['pageFilter']->getSeveritiesMinCB()])
					->addItem(get_icon('favourite', [
						'fav' => 'web.favorite.sysmapids',
						'elname' => 'sysmapid',
						'elid' => $data['map']['sysmapid']
					]))
					->addItem(get_icon('fullscreen', ['fullscreen' => $data['fullscreen']]))
			)
	)
	->addItem(
		get_header_sysmap_table($data['map']['sysmapid'], $data['map']['name'], $data['fullscreen'],
			$data['severity_min']
		)
	)
	->addItem(
		(new CDiv())
			->addClass(ZBX_STYLE_TABLE_FORMS_CONTAINER)
			->addItem(
				(new CTable())
					->addRow($actionMap)
					->addRow($imgMap)
			)
	)
	->show();
