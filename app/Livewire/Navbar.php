<?php

  namespace App\Livewire;

  use Livewire\Attributes\On;
  use Livewire\Component;

  class Navbar extends Component
  {
    public $currentSection = '';

    #[On('select-section')]
    public function setSection($section)
    {
      $this->currentSection = $section;
//        dd($this->currentSection);
    }

    #[On("clean-section")]
    public function cleanSection()
    {
      $this->currentSection = 'home';
    }

    public function render()
    {
      return view('livewire.navbar');
    }
  }
