<?php

namespace App\Spotlight;

use App\Models\Loan;
use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class SearchLoans extends SpotlightCommand
{
    /**
     * This is the name of the command that will be shown in the Spotlight component.
     */
    protected string $name = 'Search Loans by loan product name';

    /**
     * This is the description of your command which will be shown besides the command name.
     */
    protected string $description = 'view loan details';

    /**
     * You can define any number of additional search terms (also known as synonyms)
     * to be used when searching for this command.
     */
    protected array $synonyms = [];

    /**
     * Defining dependencies is optional. If you don't have any dependencies you can remove this method.
     * Dependencies are asked from your user in the order you add the dependencies.
     */
    public function dependencies(): ?SpotlightCommandDependencies
    {
        return SpotlightCommandDependencies::collection()
            ->add(
                // In this example we will register a 'team' dependency
                SpotlightCommandDependency::make('loan')
                // The default Spotlight placeholder will be changed to your dependency place holder
                ->setPlaceholder('which loan details do you want to view')
            );
    }

    /**
     * Spotlight will resolve dependencies by calling the search method followed by your dependency name.
     * The method will receive the search query as the parameter.
     */
   public function searchloan($query)
    {
       return Loan::where(function ($q) use ($query) {
        // Search in LoanProduct name
        $q->whereHas('loanProduct', function ($q) use ($query) {
            $q->where('name', 'ilike', "%$query%");
        });

            // Search in User's first_name, last_name, or email
            // $q->orWhereHas('user', function ($q) use ($query) {
            //     $q->where(function ($q) use ($query) {
            //         $q->where('first_name', 'ilike', "%$query%")
            //             ->orWhere('last_name', 'ilike', "%$query%");
            //     })
            //     ->orWhere('email', 'ilike', "%$query%");
            // });
        })
        ->get()
        ->map(function (Loan $loan) {
            return new SpotlightSearchResult(
                $loan->id,
                $loan->loanProduct->name, // Display the LoanProduct name
                sprintf('Check loan : %s, Borrower: %s', $loan->loanProduct->name, $loan->client->first_name)
            );
        });
    }

    /**
     * When all dependencies have been resolved the execute method is called.
     * You can type-hint all resolved dependency you defined earlier.
     */
    public function execute(Spotlight $spotlight, Loan $loan)
    {
        $spotlight->redirectRoute('loans.show', $loan);
    }

    /**
     * You can provide any custom logic you want to determine whether the
     * command will be shown in the Spotlight component. If you don't have any
     * logic you can remove this method. You can type-hint any dependencies you
     * need and they will be resolved from the container.
     */
    public function shouldBeShown(): bool
    {
        return true;
    }
}
