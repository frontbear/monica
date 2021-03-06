<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RelationshipTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_belongs_to_an_account()
    {
        $account = factory('App\Account')->create([]);
        $relationship = factory('App\Relationship')->create([
            'account_id' => $account->id,
        ]);

        $this->assertTrue($relationship->account()->exists());
    }

    public function test_it_belongs_to_a_contact()
    {
        $contact = factory('App\Contact')->create([]);
        $relationship = factory('App\Relationship')->create([
            'contact_is' => $contact->id,
        ]);

        $this->assertTrue($relationship->contactIs()->exists());
    }

    public function test_it_belongs_to_another_contact()
    {
        $contact = factory('App\Contact')->create([]);
        $relationship = factory('App\Relationship')->create([
            'of_contact' => $contact->id,
        ]);

        $this->assertTrue($relationship->ofContact()->exists());
    }

    public function test_it_belongs_to_a_relationship_type()
    {
        $account = factory('App\Account')->create([]);
        $relationshipType = factory('App\RelationshipType')->create([
            'account_id' => $account->id,
        ]);
        $relationship = factory('App\Relationship')->create([
            'account_id' => $account->id,
            'relationship_type_id' => $relationshipType->id,
        ]);

        $this->assertTrue($relationship->relationshipType()->exists());
    }

    public function test_it_belongs_to_a_contact_through_with_contact_field()
    {
        $contact = factory('App\Contact')->create([]);
        $relationship = factory('App\Relationship')->create([
            'of_contact' => $contact->id,
        ]);

        $this->assertTrue($relationship->ofContact()->exists());
    }
}
