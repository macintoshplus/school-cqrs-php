<?php

namespace Jbnahan\Domain\School\Specification;

use Jbnahan\Domain\School\Model\Student;

/**
 * Description of StudentsIsAdultSpec
 *
 * @author jb
 */
class StudentsIsAdultSpec {
    
    const AGE_LIMIT = 18;
    /**
     * Check if the student is adult !
     * @param \Jbnahan\Domain\School\Model\Student $student
     * @return boolean
     */
    public function isSatisfiedBy(Student $student) {
        return $student->getAge()>=StudentsIsAdultSpec::AGE_LIMIT;
    }
}
