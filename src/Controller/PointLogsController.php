<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PointLogs Controller
 *
 * @property \App\Model\Table\PointLogsTable $PointLogs
 */
class PointLogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->PointLogs->find()
            ->contain(['Users', 'Tasks']);
        $pointLogs = $this->paginate($query);

        $this->set(compact('pointLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Point Log id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pointLog = $this->PointLogs->get($id, contain: ['Users', 'Tasks']);
        $this->set(compact('pointLog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pointLog = $this->PointLogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $pointLog = $this->PointLogs->patchEntity($pointLog, $this->request->getData());
            if ($this->PointLogs->save($pointLog)) {
                $this->Flash->success(__('The point log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The point log could not be saved. Please, try again.'));
        }
        $users = $this->PointLogs->Users->find('list', limit: 200)->all();
        $tasks = $this->PointLogs->Tasks->find('list', limit: 200)->all();
        $this->set(compact('pointLog', 'users', 'tasks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Point Log id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pointLog = $this->PointLogs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pointLog = $this->PointLogs->patchEntity($pointLog, $this->request->getData());
            if ($this->PointLogs->save($pointLog)) {
                $this->Flash->success(__('The point log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The point log could not be saved. Please, try again.'));
        }
        $users = $this->PointLogs->Users->find('list', limit: 200)->all();
        $tasks = $this->PointLogs->Tasks->find('list', limit: 200)->all();
        $this->set(compact('pointLog', 'users', 'tasks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Point Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pointLog = $this->PointLogs->get($id);
        if ($this->PointLogs->delete($pointLog)) {
            $this->Flash->success(__('The point log has been deleted.'));
        } else {
            $this->Flash->error(__('The point log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
