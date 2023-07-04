<?php

namespace Selvah\Http\Livewire\Traits;

trait WithBulkActions
{
    /**
     * Whatever the current page of rows are all selected or not.
     *
     * @var false
     */
    public $selectPage = false;

    /**
     * The id array of selected rows.
     *
     * @var array
     */
    public $selected = [];

    /**
     * Whenever the user unselect a checkbox, we need to disable the selectAll option and selectPage.
     *
     * @return void
     */
    public function updatedSelected(): void
    {
        $this->selectPage = false;
    }

    /**
     * Whatever we have selected all rows in the current page.
     *
     * @param mixed $value The current page where all rows get selected.
     *
     * @return void
     */
    public function updatedSelectPage($value)
    {
        if ($value) {
            return $this->selectPageRows();
        }

        $this->selected = [];
    }

    /**
     * Convert the selected rows id into string type.
     *
     * @return void
     */
    public function selectPageRows(): void
    {
        $this->selected = $this->rows->pluck('id')->map(fn($id) => (string) $id);
    }

    /**
     * Delete all selected rows and display a flash message.
     *
     * @return void
     */
    public function deleteSelected(): void
    {
        if ($this->selected <= 0) {
            return;
        }

        if ($deleteCount = $this->model->destroy($this->selected)) {
            $this->fireFlash('delete', 'success', $deleteCount);
        } else {
            $this->fireFlash('delete', 'danger');
        }
        $this->showDeleteModal = false;
    }
}
