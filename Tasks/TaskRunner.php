<?php

namespace WikidataWorkBench\Tasks;

class TaskRunner {
    
    ///
    /// Properties
    ///
    
    public $task;
    
    ///
    /// Constructors
    ///
    
    /**
     * Initializes a new instance of the TaskRunner class
     * 
     * @param string $string the task name
     */
    public function __construct ($task) {
        $this->task = $task;
    }
    
    /**
     * Runs a specified task
     * 
     * @param string $string the task name
     */
    public static function runTask ($task) {
        $taskRunner = new static($task);
        $taskRunner->ensureTaskExists();
        $taskRunner->run();
    }
    
    ///
    /// Class helper methods
    ///
    
    /**
     * The default namespace where tasks are stored
     */
    const DEFAULT_NAMESPACE = 'WikidataWorkBench\Tasks';
    
    /**
     * Gets class name
     * 
     * @return string the fully qualified class name, with namespace
     */
    public function getClassName () {
        return static::DEFAULT_NAMESPACE . '\\' . $this->task;
    }
    
    /**
     * Determines if the task exist
     * 
     * @return bool true if the task exists; otherwise, false.
     */
    public function doesTaskExist () {
        $class = $this->getClassName();
        return class_exists($class);
    }
    
    /**
     * Ensures the task exists and throws an exception if not
     */
    public function ensureTaskExists () {
        if (!$this->doesTaskExist()) {
            throw new \InvalidArgumentException("Task doesn't exist: $this->task");
        }
    }
    
    ///
    /// Tasks methods
    ///
    
    /**
     * Runs the task
     */
    public function run () {
        $class = $this->getClassName();
        $class::run();
    }
}
