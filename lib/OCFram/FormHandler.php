<?php

namespace OCFram;


class FormHandler {
    /**
     * @var Form $form
     */
    protected $form;
    /**
     * @var Manager $manager
     */
    protected $manager;
    /**
     * @var HTTPRequest $request
     */
    protected $request;

    /**
     * FormHandler constructor.
     * @param Form $form
     * @param Manager $manager
     * @param HTTPRequest $request
     * @return void
     */
    public function __construct(Form $form, Manager $manager, HTTPRequest $request) {
        $this->setForm($form);
        $this->setManager($manager);
        $this->setRequest($request);
    }

    /**
     * Check if the form has well been sent and is valid, and save it if it does.
     * @return bool
     */
    public function process() {
        if ($this->request->method() == 'POST' && $this->form->isValid()) {
            $this->manager->save($this->form->entity());
            return true;
        }
        return false;
    }

    /**
     * Setter for $form.
     * @param Form $form
     * @return void
     */
    public function setForm(Form $form) {
        $this->form = $form;
    }

    /**
     * Setter for $manager.
     * @param Manager $manager
     * @return void
     */
    public function setManager(Manager $manager) {
        $this->manager = $manager;
    }

    /**
     * Setter for $request.
     * @param HTTPRequest $request
     * @return void
     */
    public function setRequest(HTTPRequest $request) {
        $this->request = $request;

    }
}