<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Badges Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Badge newEmptyEntity()
 * @method \App\Model\Entity\Badge newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Badge> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Badge get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Badge findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Badge patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Badge> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Badge|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Badge saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Badge>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Badge>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Badge>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Badge> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Badge>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Badge>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Badge>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Badge> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BadgesTable extends Table
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

        $this->setTable('badges');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Users', [
            'foreignKey' => 'badge_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'badges_users',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 255)
            ->allowEmptyString('icon');

        return $validator;
    }
}
