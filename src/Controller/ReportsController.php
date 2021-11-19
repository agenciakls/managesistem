<?php
declare(strict_types=1);
namespace App\Controller;
use Cake\ORM\TableRegistry;
class ReportsController extends AppController {
    public function index() {
    }
    public function count() {
        /* -------------------- TABELAS USADAS -------------------- */
        $listClients = TableRegistry::get('clients');
        $listUsers = TableRegistry::get('users');
        $listService = TableRegistry::get('services');
        $listCosts = TableRegistry::get('costs');
        /* -------------------- SELECT -------------------- */
        $allTechnicians = $listUsers->find('all')->where(['role_id' => 2]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));
        $allSellers = $listUsers->find('all')->where(['status' => 1]);
        $sellers[0] = 'Sem Vendedor';
        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));
        /* -------------------- FORMULÁRIO GET - FILTRO -------------------- */
        $technician_id = ($this->request->getQuery('technician_id')) ? $this->request->getQuery('technician_id'): null;
        $seller_id = ($this->request->getQuery('seller_id')) ? $this->request->getQuery('seller_id'): null;
        $dateStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime($this->request->getQuery('datestart'))): null;
        $dateEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $stampStart = ($this->request->getQuery('datestart')) ? strftime("%d/%m/%Y", strtotime($this->request->getQuery('datestart'))): null;
        $stampEnd = ($this->request->getQuery('dateend')) ? strftime("%d/%m/%Y", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $insertStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d", strtotime($this->request->getQuery('datestart'))): null;
        $insertEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $mensagemStamp = ($stampStart && $stampEnd) ? '' . $stampStart . ' - ' . $stampEnd . '': false;
        $this->set(compact('mensagemStamp'));
        $this->set(compact('insertStart'));
        $this->set(compact('insertEnd'));
        $mensagemPeriodo = false;
        $periodo = [];
        $periodoServicos = [];
        if ($dateStart and $dateEnd and ($dateStart <= $dateEnd)) {
            $periodo = [
                'conditions' => [
                    'AND' => [
                        'date >= ' => $dateStart,
                        'date <= ' => $dateEnd,
                        $technician_id,
                        $seller_id
                    ]
                ]
            ];
            $periodoServicos = $periodo;
            if ($technician_id) { $periodoServicos['conditions']['AND']['technician_id'] = $technician_id; }
            if ($seller_id) { $periodoServicos['conditions']['AND']['seller_id'] = $seller_id; }
        }
        else if ($dateStart and $dateEnd and ($dateStart >= $dateEnd)) {
            $mensagemPeriodo = 'A data inicial deve ser antes da data final.';
        }
        $this->set(compact('mensagemPeriodo'));
        /* -------------------- MÉTRICAS -------------------- */
        $clientes = $listClients->find('all');
        $clientesQuantity = $clientes->count();
        $this->set(compact('clientesQuantity'));
        $servicos = $listService->find('all', $periodoServicos);
        $servicosQuantity = $servicos->count();
        $this->set(compact('servicosQuantity'));
        $servicosCancelados = $listService->find('all', $periodoServicos)->where(['situation_id' => 2]);
        $servicosCanceladosQuantity = $servicosCancelados->count();
        $this->set(compact('servicosCanceladosQuantity'));
        $servicosAguardando = $listService->find('all', $periodoServicos)->where(['situation_id IN ' => [1, 4, 5, 6]]);
        $servicosAguardandoQuantity = $servicosAguardando->count();
        $this->set(compact('servicosAguardandoQuantity'));
        $despesas = $listCosts->find('all', $periodo);
        $despesasQuantity = $despesas->count();
        $this->set(compact('despesasQuantity'));
        $usuarios = $listUsers->find('all')->where(['role_id' => 2]);
        $usuariosQuantity = $usuarios->count();
        $this->set(compact('usuariosQuantity'));
        /* -------------------- VALORES -------------------- */
        $servicos = $listService->find('all', $periodoServicos)->where(['situation_id != ' => 2]);
        $totalReceita = 0;
        foreach ($servicos as $singleService) {
            $totalReceita += $singleService->price;
        }
        $this->set(compact('totalReceita'));
        $servicos = $listService->find('all', $periodoServicos)->where(['situation_id IN ' => [3, 4, 7]]);
        $totalServicos = 0;
        foreach ($servicos as $singleService) {
            $totalServicos += $singleService->price;
        }
        $this->set(compact('totalServicos'));
        $servicos = $listService->find('all', $periodoServicos)->where(['situation_id IN ' => [1, 5, 6]]);
        $totalServicosPendentes = 0;
        foreach ($servicos as $singleService) {
            $totalServicosPendentes += $singleService->price;
        }
        $this->set(compact('totalServicosPendentes'));
        $servicos = $listService->find('all', $periodoServicos)->where(['situation_id' => 2]);
        $totalServicosCancelado = 0;
        foreach ($servicos as $singleService) {
            $totalServicosCancelado += $singleService->price;
        }
        $this->set(compact('totalServicosCancelado'));

        $despesas = $listCosts->find('all', $periodo)->where(['statuscost_id' => 1]);
        $totalDespesasPagas = 0;
        foreach ($despesas as $singleService) {
            $totalDespesasPagas += $singleService->price;
        }
        $this->set(compact('totalDespesasPagas'));

        $despesasTotal = $listCosts->find('all', $periodo);
        $totalDespesas = 0;
        foreach ($despesasTotal as $singleService) {
            $totalDespesas += $singleService->price;
        }
        $this->set(compact('totalDespesas'));

        $lucroAtual = $totalServicos - $totalDespesasPagas;
        $this->set(compact('lucroAtual'));
        $despesasFuturas = $listCosts->find('all', $periodo);
        $totalDespesasFuturas = 0;
        foreach ($despesasFuturas as $singleService) {
            $totalDespesasFuturas += $singleService->price;
        }
        $this->set(compact('totalDespesasFuturas'));
        $lucroFuturo = $totalServicos - $totalDespesasFuturas + $totalServicosPendentes;
        $this->set(compact('lucroFuturo'));
    }
    public function list() {
        /* -------------------- TABELAS USADAS -------------------- */
        $listClients = TableRegistry::get('clients');
        $listUsers = TableRegistry::get('users');
        $listService = TableRegistry::get('Services');
        $listCosts = TableRegistry::get('costs');
        $listSituation = TableRegistry::get('situations');
        /* -------------------- SELECT -------------------- */
        $allTechnicians = $listUsers->find('all')->where(['role_id' => 2]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));
        $allSellers = $listUsers->find('all')->where(['status' => 1]);
        $sellers[0] = 'Sem Vendedor';
        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));
        $listPaid = TableRegistry::get('paids');
        $allPaids = $listPaid->find('all');
        $paidsLabel[0] = 'Todos';
        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
            $paidsLabel[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));
        $this->set(compact('paidsLabel'));
        $listMethod = TableRegistry::get('methods');
        $allMethods = $listMethod->find('all');
        $methodsLabel[0] = 'Todos';
        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
            $methodsLabel[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));
        $this->set(compact('methodsLabel'));
        $allSituations = $listSituation->find('all');
        $situationsLabel[0] = 'Todos';
        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
            $situationsLabel[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));
        $this->set(compact('situationsLabel'));
        /* -------------------- FORMULÁRIO GET - FILTRO -------------------- */
        $technician_id = ($this->request->getQuery('technician_id')) ? $this->request->getQuery('technician_id'): null;
        $seller_id = ($this->request->getQuery('seller_id')) ? $this->request->getQuery('seller_id'): null;
        $situation_id = ($this->request->getQuery('situation_id')) ? $this->request->getQuery('situation_id'): null;
        $method_id = ($this->request->getQuery('method_id')) ? $this->request->getQuery('method_id'): null;
        $paid_id = ($this->request->getQuery('paid_id')) ? $this->request->getQuery('paid_id'): null;
        $this->set(compact('technician_id'));
        $this->set(compact('seller_id'));
        $this->set(compact('situation_id'));
        $this->set(compact('method_id'));
        $this->set(compact('paid_id'));
        $dateStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime($this->request->getQuery('datestart'))): null;
        $dateEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $stampStart = ($this->request->getQuery('datestart')) ? strftime("%d/%m/%Y", strtotime($this->request->getQuery('datestart'))): null;
        $stampEnd = ($this->request->getQuery('dateend')) ? strftime("%d/%m/%Y", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $insertStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d", strtotime($this->request->getQuery('datestart'))): null;
        $insertEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $mensagemStamp = ($stampStart && $stampEnd) ? '' . $stampStart . ' - ' . $stampEnd . '': false;
        $this->set(compact('mensagemStamp'));
        $this->set(compact('insertStart'));
        $this->set(compact('insertEnd'));
        $mensagemPeriodo = false;
        $periodo = [];
        $periodoServicos = [];
        if ($dateStart and $dateEnd and ($dateStart <= $dateEnd)) {
            $periodo = [
                'conditions' => [
                    'AND' => [
                        'date >= ' => $dateStart,
                        'date <= ' => $dateEnd,
                        $technician_id,
                        $seller_id,
                        $situation_id,
                        $method_id,
                        $paid_id
                    ]
                ]
            ];
            $periodoServicos = $periodo;
            if ($technician_id) { $periodoServicos['conditions']['AND']['technician_id'] = $technician_id; }
            if ($seller_id) { $periodoServicos['conditions']['AND']['seller_id'] = $seller_id; }
            if ($situation_id) { $periodoServicos['conditions']['AND']['situation_id'] = $situation_id; }
            if ($method_id) { $periodoServicos['conditions']['AND']['method_id'] = $method_id; }
            if ($paid_id) { $periodoServicos['conditions']['AND']['paid_id'] = $paid_id; }
        }
        else if ($dateStart and $dateEnd and ($dateStart >= $dateEnd)) {
            $mensagemPeriodo = 'A data inicial deve ser antes da data final.';
        }
        $this->set(compact('mensagemPeriodo'));
        $services = $this->paginate($listService->find('all', $periodoServicos)->contain(['Clients', 'Situations'])->order(['date' => 'ASC']));
        $this->set(compact('services'));
    }
    public function costs() {
        $listStatuscost = TableRegistry::get('Statuscosts');
        $allStatuscosts = $listStatuscost->find('all');
        $statuscostsLabel[0] = 'Todos';
        foreach ($allStatuscosts as $statuscostSingle) {
            $idSituation = $statuscostSingle->id;
            $statuscosts[$idSituation] = $statuscostSingle->title;
            $statuscostsLabel[$idSituation] = $statuscostSingle->title;
        }
        $this->set(compact('statuscosts'));
        $this->set(compact('statuscostsLabel'));
        $listExpense = TableRegistry::get('Expenses');
        $allExpenses = $listExpense->find('all');
        $expensesLabel[0] = 'Todos';
        foreach ($allExpenses as $expenseSingle) {
            $idSituation = $expenseSingle->id;
            $expenses[$idSituation] = $expenseSingle->title;
            $expensesLabel[$idSituation] = $expenseSingle->title;
        }
        $this->set(compact('expenses'));
        $this->set(compact('expensesLabel'));
        $listMethod = TableRegistry::get('Methods');
        $allMethods = $listMethod->find('all');
        $methodsLabel[0] = 'Todos';
        foreach ($allMethods as $methodSingle) {
            $idSituation = $methodSingle->id;
            $methods[$idSituation] = $methodSingle->title;
            $methodsLabel[$idSituation] = $methodSingle->title;
        }
        $this->set(compact('methods'));
        $this->set(compact('methodsLabel'));
        $method_id = ($this->request->getQuery('method_id')) ? $this->request->getQuery('method_id'): null;
        $expense_id = ($this->request->getQuery('expense_id')) ? $this->request->getQuery('expense_id'): null;
        $statuscost_id = ($this->request->getQuery('statuscost_id')) ? $this->request->getQuery('statuscost_id'): null;
        $this->set(compact('method_id'));
        $this->set(compact('expense_id'));
        $this->set(compact('statuscost_id'));
        $dateStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime($this->request->getQuery('datestart'))): null;
        $dateEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $stampStart = ($this->request->getQuery('datestart')) ? strftime("%d/%m/%Y", strtotime($this->request->getQuery('datestart'))): null;
        $stampEnd = ($this->request->getQuery('dateend')) ? strftime("%d/%m/%Y", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $insertStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d", strtotime($this->request->getQuery('datestart'))): null;
        $insertEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $mensagemStamp = ($stampStart && $stampEnd) ? '' . $stampStart . ' - ' . $stampEnd . '': false;
        $this->set(compact('mensagemStamp'));
        $this->set(compact('insertStart'));
        $this->set(compact('insertEnd'));
        $mensagemPeriodo = false;
        $periodo = [];
        $periodoCosts = [];
        if ($dateStart and $dateEnd and ($dateStart <= $dateEnd)) {
            $periodo = [
                'conditions' => [
                    'AND' => [
                        'date >= ' => $dateStart,
                        'date <= ' => $dateEnd,
                        $method_id,
                        $expense_id,
                        $statuscost_id
                    ]
                ]
            ];
            $periodoCosts = $periodo;
            if ($statuscost_id) { $periodoCosts['conditions']['AND']['statuscost_id'] = $statuscost_id; }
            if ($expense_id) { $periodoCosts['conditions']['AND']['expense_id'] = $expense_id; }
            if ($method_id) { $periodoCosts['conditions']['AND']['method_id'] = $method_id; }
        }
        else if ($dateStart and $dateEnd and ($dateStart >= $dateEnd)) {
            $mensagemPeriodo = 'A data inicial deve ser antes da data final.';
        }
        $this->set(compact('mensagemPeriodo'));
        $listExpenses = TableRegistry::get('Costs');
        if ($this->request->getQuery('datestart') && $this->request->getQuery('dateend')) {
            $costs = $listExpenses->find('all', $periodoCosts)->contain(['Statuscosts', 'Expenses'])->order(['date' => 'ASC']);
        }
        else {
            $costs = $this->paginate($listExpenses->find('all', $periodoCosts)->contain(['Statuscosts', 'Expenses'])->order(['date' => 'ASC']));
        }
        $this->set(compact('costs'));
    }
    public function person() {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        /* -------------------- TABELAS USADAS -------------------- */
        $listClients = TableRegistry::get('clients');
        $listUsers = TableRegistry::get('users');
        $listService = TableRegistry::get('Services');
        $listCosts = TableRegistry::get('costs');
        $listSituation = TableRegistry::get('situations');
        /* -------------------- SELECT -------------------- */
        $allTechnicians = $listUsers->find('all')->where(['role_id' => 2]);
        $technicians[0] = 'Sem Técnico';
        foreach ($allTechnicians as $technicianSingle) {
            $idTechnician = $technicianSingle->id;
            $technicians[$idTechnician] = $technicianSingle->name;
        }
        $this->set(compact('technicians'));
        $allSellers = $listUsers->find('all')->where(['status' => 1]);
        $sellers[0] = 'Sem Vendedor';
        foreach ($allSellers as $sellerSingle) {
            $idSeller = $sellerSingle->id;
            $sellers[$idSeller] = $sellerSingle->name;
        }
        $this->set(compact('sellers'));
        $listPaid = TableRegistry::get('paids');
        $allPaids = $listPaid->find('all');
        $paidsLabel[0] = 'Todos';
        foreach ($allPaids as $paidSingle) {
            $idPaid = $paidSingle->id;
            $paids[$idPaid] = $paidSingle->title;
            $paidsLabel[$idPaid] = $paidSingle->title;
        }
        $this->set(compact('paids'));
        $this->set(compact('paidsLabel'));
        $listMethod = TableRegistry::get('methods');
        $allMethods = $listMethod->find('all');
        $methodsLabel[0] = 'Todos';
        foreach ($allMethods as $methodSingle) {
            $idMethod = $methodSingle->id;
            $methods[$idMethod] = $methodSingle->title;
            $methodsLabel[$idMethod] = $methodSingle->title;
        }
        $this->set(compact('methods'));
        $this->set(compact('methodsLabel'));
        $allSituations = $listSituation->find('all');
        $situationsLabel[0] = 'Todos';
        foreach ($allSituations as $situationSingle) {
            $idSituation = $situationSingle->id;
            $situations[$idSituation] = $situationSingle->title;
            $situationsLabel[$idSituation] = $situationSingle->title;
        }
        $this->set(compact('situations'));
        $this->set(compact('situationsLabel'));
        /* -------------------- FORMULÁRIO GET - FILTRO -------------------- */
        $technician_id = ($this->request->getQuery('technician_id')) ? $this->request->getQuery('technician_id'): null;
        $seller_id = ($this->request->getQuery('seller_id')) ? $this->request->getQuery('seller_id'): null;
        $situation_id = ($this->request->getQuery('situation_id')) ? $this->request->getQuery('situation_id'): null;
        $method_id = ($this->request->getQuery('method_id')) ? $this->request->getQuery('method_id'): null;
        $paid_id = ($this->request->getQuery('paid_id')) ? $this->request->getQuery('paid_id'): null;
        $this->set(compact('technician_id'));
        $this->set(compact('seller_id'));
        $this->set(compact('situation_id'));
        $this->set(compact('method_id'));
        $this->set(compact('paid_id'));
        $dateStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime($this->request->getQuery('datestart'))): null;
        $dateEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d %H:%M:%S", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $stampStart = ($this->request->getQuery('datestart')) ? strftime("%d/%m/%Y", strtotime($this->request->getQuery('datestart'))): null;
        $stampEnd = ($this->request->getQuery('dateend')) ? strftime("%d/%m/%Y", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $insertStart = ($this->request->getQuery('datestart')) ? strftime("%Y-%m-%d", strtotime($this->request->getQuery('datestart'))): null;
        $insertEnd = ($this->request->getQuery('dateend')) ? strftime("%Y-%m-%d", strtotime("+23 hours 59 seconds", strtotime($this->request->getQuery('dateend')))): null;
        $mensagemStamp = ($stampStart && $stampEnd) ? '' . $stampStart . ' - ' . $stampEnd . '': false;
        $this->set(compact('mensagemStamp'));
        $this->set(compact('insertStart'));
        $this->set(compact('insertEnd'));
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
        $services = $this->paginate($listService->find('all', $periodoServicos)->where(['seller_id' => $this->usuarioAtual['id']])->contain(['Clients', 'Situations'])->order(['date' => 'ASC']));
        $this->set(compact('services'));
    }
    public function graphics () {
        /* -------------------- TABELAS USADAS -------------------- */
        $listClients = TableRegistry::get('clients');
        $listUsers = TableRegistry::get('users');
        $listService = TableRegistry::get('Services');
        $listCosts = TableRegistry::get('costs');
        $listSituation = TableRegistry::get('situations');
        $arrayGraphics = array();
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
            $arrayGraphics[$month]['servicosQuantity'] = $servicosQuantity;
            $servicosCancelados = $listService->find('all', $periodoServicos)->where(['situation_id' => 2]);
            $servicosCanceladosQuantity = $servicosCancelados->count();
            $arrayGraphics[$month]['servicosCanceladosQuantity'] = $servicosCanceladosQuantity;
            $servicosAguardando = $listService->find('all', $periodoServicos)->where(['situation_id IN ' => [1, 4, 5, 6]]);
            $servicosAguardandoQuantity = $servicosAguardando->count();
            $arrayGraphics[$month]['servicosAguardandoQuantity'] = $servicosAguardandoQuantity;
            $despesas = $listCosts->find('all', $periodoServicos);
            $despesasQuantity = $despesas->count();
            $arrayGraphics[$month]['despesasQuantity'] = $despesasQuantity;
            $usuarios = $listUsers->find('all')->where(['role_id' => 2]);
            $usuariosQuantity = $usuarios->count();
            $arrayGraphics[$month]['usuariosQuantity'] = $usuariosQuantity;
            /* -------------------- VALORES -------------------- */
            $servicos = $listService->find('all', $periodoServicos)->where(['situation_id != ' => 2]);
            $totalReceita = 0;
            foreach ($servicos as $singleService) {
                $totalReceita += $singleService->price;
            }
            $arrayGraphics[$month]['totalReceita'] = $totalReceita;
            $servicos = $listService->find('all', $periodoServicos)->where(['situation_id IN ' => [3, 7]]);
            $totalServicos = 0;
            foreach ($servicos as $singleService) {
                $totalServicos += $singleService->price;
            }
            $arrayGraphics[$month]['totalServicos'] = $totalServicos;
            $servicos = $listService->find('all', $periodoServicos)->where(['situation_id IN ' => [1, 4, 5, 6]]);
            $totalServicosPendentes = 0;
            foreach ($servicos as $singleService) {
                $totalServicosPendentes += $singleService->price;
            }
            $arrayGraphics[$month]['totalServicosPendentes'] = $totalServicosPendentes;
            $servicos = $listService->find('all', $periodoServicos)->where(['situation_id' => 2]);
            $totalServicosCancelado = 0;
            foreach ($servicos as $singleService) {
                $totalServicosCancelado += $singleService->price;
            }
            $arrayGraphics[$month]['totalServicosCancelado'] = $totalServicosCancelado;
            $despesas = $listCosts->find('all', $periodo);
            $totalDespesas = 0;
            foreach ($despesas as $singleService) {
                $totalDespesas += $singleService->price;
            }
            $arrayGraphics[$month]['totalDespesas'] = $totalDespesas;
            $lucroAtual = $totalServicos - $totalDespesas;
            $arrayGraphics[$month]['lucroAtual'] = $lucroAtual;
        }
        $this->set(compact('arrayGraphics'));
    }
}
