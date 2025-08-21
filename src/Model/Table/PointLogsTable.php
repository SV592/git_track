<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PointLogs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\TasksTable&\Cake\ORM\Association\BelongsTo $Tasks
 *
 * @method \App\Model\Entity\PointLog newEmptyEntity()
 * @method \App\Model\Entity\PointLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PointLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PointLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PointLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PointLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PointLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PointLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PointLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PointLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PointLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PointLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PointLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PointLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PointLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PointLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PointLog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PointLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('point_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('points_earned')
            ->requirePresence('points_earned', 'create')
            ->notEmptyString('points_earned');

        $validator
            ->integer('task_id')
            ->allowEmptyString('task_id');

        $validator
            ->scalar('reason')
            ->maxLength('reason', 255)
            ->allowEmptyString('reason');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['task_id'], 'Tasks'), ['errorField' => 'task_id']);

        return $rules;
    }
}
