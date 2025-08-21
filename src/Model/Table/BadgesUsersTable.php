<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BadgesUsers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BadgesTable&\Cake\ORM\Association\BelongsTo $Badges
 *
 * @method \App\Model\Entity\BadgesUser newEmptyEntity()
 * @method \App\Model\Entity\BadgesUser newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\BadgesUser> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BadgesUser get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\BadgesUser findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\BadgesUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\BadgesUser> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BadgesUser|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\BadgesUser saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\BadgesUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BadgesUser>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BadgesUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BadgesUser> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BadgesUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BadgesUser>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BadgesUser>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BadgesUser> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BadgesUsersTable extends Table
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

        $this->setTable('badges_users');
        $this->setDisplayField(['user_id', 'badge_id']);
        $this->setPrimaryKey(['user_id', 'badge_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Badges', [
            'foreignKey' => 'badge_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn(['badge_id'], 'Badges'), ['errorField' => 'badge_id']);

        return $rules;
    }
}
