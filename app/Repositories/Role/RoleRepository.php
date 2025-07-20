<?php

namespace App\Repositories\Role;

class RoleRepository
{
    /**
     * function for get data on databases
     */
    public function get(array $request): mixed
    {
        $getter = app(Getter::class);
        $results = $getter->prepare($request)->execute();

        return $results;
    }

    /**
     * Get one data by id with specific option
     */
    public function findOne(int $id, bool $withPermission, bool $isTree): ?array
    {
        return app(Getter::class)->findOne($id, $withPermission, $isTree);
    }

    /**
     * Do storeing role on db and return when data is stored
     */
    public function create(array $request): ?array
    {
        $creator = app(Creator::class);
        $results = $creator->prepare($request)->execute();

        if ($results === null) {
            return $results;
        }

        return app(Getter::class)->simpleFindOne($results);
    }

    /**
     * Do updating role on db and return when data is updated
     */
    public function update(int $id, array $request): ?array
    {
        $updater = app(Updater::class);
        $results = $updater->prepare($id, $request)->execute();

        if ($results === null) {
            return $results;
        }

        return app(Getter::class)->simpleFindOne($results);
    }

    /**
     * Do deleting role on db
     */
    public function delete(int $id, ?array $options = []): void
    {
        $deleter = app(Deleter::class);
        $results = $deleter->prepare($id, $options)->execute();
    }
}
