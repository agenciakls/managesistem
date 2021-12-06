<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class DashboardController extends AppController
{
    public function index()
    {
        /* -------------------- TABELAS USADAS -------------------- */
        $listClients = TableRegistry::get('clients');
        $listUsers = TableRegistry::get('users');
        $listService = TableRegistry::get('services');
        $listCosts = TableRegistry::get('costs');
        $listPaid = TableRegistry::get('paids');
        $listPacks = TableRegistry::get('packs');

        /* -------------------- FORMULÁRIO GET - FILTRO -------------------- */
        $periodo = [];
        $periodoServicos = [];

        /* -------------------- MÉTRICAS -------------------- */
        $clientes = $listClients->find('all');
        $clientesQuantity = $clientes->count();
        $this->set(compact('clientesQuantity'));

        $servicos = $listService->find('all', $periodoServicos);
        $servicosQuantity = $servicos->count();
        $this->set(compact('servicosQuantity'));

        $servicosAguardando = $listService->find('all', $periodoServicos)->where(['paid_id' => 1]);
        $servicosAguardandoQuantity = $servicosAguardando->count();
        $this->set(compact('servicosAguardandoQuantity'));

        $dateCurrent = date('Y-m-d H:i:s', strtotime('now'));
        $servicosAtrasados = $listService->find('all', [ 'conditions' => [ 'AND' => [ 'delivery <= ' => $dateCurrent, ] ] ])->where(['paid_id' => 1]);
        $servicosAtrasadosQuantity = $servicosAtrasados->count();
        $this->set(compact('servicosAtrasadosQuantity'));

        $produtos = $listPacks->find('all');
        $produtosQuantity = $produtos->count();
        $this->set(compact('produtosQuantity'));

        $users = $listUsers->find()->where(['status' => 1]);
        $this->set(compact('users'));

        $usersResults = array();
        foreach ($users as $user) {
            $userId = $user->id;

            $listTotalServices = $listService->find()->where(['seller_id' => $userId]);
            $quantityService = $listTotalServices->count();
            $usersResults[$userId] = $quantityService;
        }
        $this->set(compact('usersResults'));

        /* -------------------- RELATÓRIO DIAS -------------------- */
        $arrayGraphics = array();
        for ($i = 30; $i >= 0; $i--) {

            $query_date = date('Y-m-d', strtotime(-$i . 'day'));
            $arraySeparator = ($i == 0) ? 'Hoje': (string) date('d/m', strtotime($query_date));
            $dateStart = date('Y-m-d 00:00:00', strtotime($query_date));
            $dateEnd = date('Y-m-d 23:59:59', strtotime($query_date));

            $periodo = [];
            $periodoServicos = [];
            if ($dateStart and $dateEnd and ($dateStart <= $dateEnd)) {
                $periodo = [
                    'conditions' => [
                        'AND' => [
                            'date >= ' => $dateStart,
                            'date <= ' => $dateEnd
                        ]
                    ]
                ];
                $periodoServicos = $periodo;
            }

            $servicos = $listService->find('all', $periodoServicos);
            $servicosQuantity = $servicos->count();
            $arrayGraphics[$arraySeparator]['servicosQuantity'] = $servicosQuantity;

            $servicosConcluidos = $listService->find('all', $periodoServicos)->where(['paid_id IN ' => [2]]);
            $servicosConcluidosQuantity = $servicosConcluidos->count();
            $arrayGraphics[$arraySeparator]['servicosConcluidosQuantity'] = $servicosConcluidosQuantity;

            $servicosAguardando = $listService->find('all', $periodoServicos)->where(['paid_id' => 1]);
            $servicosAguardandoQuantity = $servicosAguardando->count();
            $arrayGraphics[$arraySeparator]['servicosAguardandoQuantity'] = $servicosAguardandoQuantity;

            $dateCurrent = date('Y-m-d H:i:s', strtotime('now'));
            $servicosAtrasados = $listService->find('all', [ 'conditions' => [ 'AND' => [ 'delivery <= ' => $dateCurrent, 'date >= ' => $dateStart, 'date <= ' => $dateEnd ] ] ])->where(['paid_id' => 1]);
            $servicosAtrasadosQuantity = $servicosAtrasados->count();
            $arrayGraphics[$arraySeparator]['servicosAtrasadosQuantity'] = $servicosAtrasadosQuantity;
        }
        $this->set(compact('arrayGraphics'));


        /* -------------------- RELATÓRIO DIAS -------------------- */
        $monthGraphics = array();
        for ($i = 7; $i >= -1; $i--) {

            $query_date = date('Y-m-d', strtotime(-$i . 'month'));
            $month = (int) date('n', strtotime($query_date));
            $dateStart = date('Y-m-01', strtotime($query_date));
            switch ($month) {
                case 1: $month = 'Janeiro'; break;
                case 2: $month = 'Fevereiro'; break;
                case 3: $month = 'Março'; break;
                case 4: $month = 'Abril'; break;
                case 5: $month = 'Maio'; break;
                case 6: $month = 'Junho'; break;
                case 7: $month = 'Julho'; break;
                case 8: $month = 'Agosto'; break;
                case 9: $month = 'Setembro'; break;
                case 10: $month = 'Outubro'; break;
                case 11: $month = 'Novembro'; break;
                case 12: $month = 'Dezembro'; break;
            }

            // Last day of the month.
            $dateEnd = date('Y-m-t', strtotime($query_date));

            $mensagemPeriodo = false;
            $periodo = [];
            $periodoServicos = [];
            if ($dateStart and $dateEnd and ($dateStart <= $dateEnd)) {
                $periodo = [
                    'conditions' => [
                        'AND' => [
                            'date >= ' => $dateStart,
                            'date <= ' => $dateEnd
                        ]
                    ]
                ];
                $periodoServicos = $periodo;
            }
            else if ($dateStart and $dateEnd and ($dateStart >= $dateEnd)) {
                $mensagemPeriodo = 'A data inicial deve ser antes da data final.';
            }
            $this->set(compact('mensagemPeriodo'));

            $servicos = $listService->find('all', $periodoServicos);
            $servicosQuantity = $servicos->count();
            $monthGraphics[$month]['servicosQuantity'] = $servicosQuantity;

            $servicosConcluidos = $listService->find('all', $periodoServicos)->where(['paid_id' => 2]);
            $servicosConcluidosQuantity = $servicosConcluidos->count();
            $monthGraphics[$month]['servicosConcluidosQuantity'] = $servicosConcluidosQuantity;

            $servicosAguardando = $listService->find('all', $periodoServicos)->where(['paid_id IN ' => [1, 4, 5, 6]]);
            $servicosAguardandoQuantity = $servicosAguardando->count();
            $monthGraphics[$month]['servicosAguardandoQuantity'] = $servicosAguardandoQuantity;


            $dateCurrent = date('Y-m-d H:i:s', strtotime('now'));
            $servicosAtrasados = $listService->find('all', [ 'conditions' => [ 'AND' => [ 'delivery <= ' => $dateCurrent, 'date >= ' => $dateStart, 'date <= ' => $dateEnd ] ] ])->where(['paid_id' => 1]);
            $servicosAtrasadosQuantity = $servicosAtrasados->count();
            $monthGraphics[$month]['servicosAtrasadosQuantity'] = $servicosAtrasadosQuantity;

            $despesas = $listCosts->find('all', $periodoServicos);
            $despesasQuantity = $despesas->count();
            $monthGraphics[$month]['despesasQuantity'] = $despesasQuantity;

            $usuarios = $listUsers->find('all')->where(['role_id' => 2]);
            $usuariosQuantity = $usuarios->count();
            $monthGraphics[$month]['usuariosQuantity'] = $usuariosQuantity;

            /* -------------------- VALORES -------------------- */
            $servicos = $listService->find('all', $periodoServicos)->where(['paid_id != ' => 2]);
            $totalReceita = 0;
            foreach ($servicos as $singleService) {
                $totalReceita += $singleService->price;
            }
            $monthGraphics[$month]['totalReceita'] = $totalReceita;

            $servicos = $listService->find('all', $periodoServicos)->where(['paid_id IN ' => [3, 7]]);
            $totalServicos = 0;
            foreach ($servicos as $singleService) {
                $totalServicos += $singleService->price;
            }
            $monthGraphics[$month]['totalServicos'] = $totalServicos;

            $servicos = $listService->find('all', $periodoServicos)->where(['paid_id IN ' => [1, 4, 5, 6]]);
            $totalServicosPendentes = 0;
            foreach ($servicos as $singleService) {
                $totalServicosPendentes += $singleService->price;
            }
            $monthGraphics[$month]['totalServicosPendentes'] = $totalServicosPendentes;

            $servicos = $listService->find('all', $periodoServicos)->where(['paid_id' => 2]);
            $totalServicosCancelado = 0;
            foreach ($servicos as $singleService) {
                $totalServicosCancelado += $singleService->price;
            }
            $monthGraphics[$month]['totalServicosCancelado'] = $totalServicosCancelado;

            $despesas = $listCosts->find('all', $periodo);
            $totalDespesas = 0;
            foreach ($despesas as $singleService) {
                $totalDespesas += $singleService->price;
            }
            $monthGraphics[$month]['totalDespesas'] = $totalDespesas;

            $lucroAtual = $totalServicos - $totalDespesas;
            $monthGraphics[$month]['lucroAtual'] = $lucroAtual;
        }
        $this->set(compact('monthGraphics'));
   }
}
