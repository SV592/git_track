<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BadgesUsers Controller
 *
 * @property \App\Model\Table\BadgesUsersTable $BadgesUsers
 */
class BadgesUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->BadgesUsers->find()
            ->contain(['Users', 'Badges']);
        $badgesUsers = $this->paginate($query);

        $this->set(compact('badgesUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Badges User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $badgesUser = $this->BadgesUsers->get($id, contain: ['Users', 'Badges']);
        $this->set(compact('badgesUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $badgesUser = $this->BadgesUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $badgesUser = $this->BadgesUsers->patchEntity($badgesUser, $this->request->getData());
            if ($this->BadgesUsers->save($badgesUser)) {
                $this->Flash->success(__('The badges user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The badges user could not be saved. Please, try again.'));
        }
        $users = $this->BadgesUsers->Users->find('list', limit: 200)->all();
        $badges = $this->BadgesUsers->Badges->find('list', limit: 200)->all();
        $this->set(compact('badgesUser', 'users', 'badges'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Badges User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $badgesUser = $this->BadgesUsers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $badgesUser = $this->BadgesUsers->patchEntity($badgesUser, $this->request->getData());
            if ($this->BadgesUsers->save($badgesUser)) {
                $this->Flash->success(__('The badges user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The badges user could not be saved. Please, try again.'));
        }
        $users = $this->BadgesUsers->Users->find('list', limit: 200)->all();
        $badges = $this->BadgesUsers->Badges->find('list', limit: 200)->all();
        $this->set(compact('badgesUser', 'users', 'badges'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Badges User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $badgesUser = $this->BadgesUsers->get($id);
        if ($this->BadgesUsers->delete($badgesUser)) {
            $this->Flash->success(__('The badges user has been deleted.'));
        } else {
            $this->Flash->error(__('The badges user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
