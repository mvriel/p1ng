<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.phpdoctrine.org>.
 */

/**
 * Listener for the Signable behavior which automatically sets the created by
 * and updated by columns when a record is inserted and updated.
 *
 * @package     Doctrine
 * @subpackage  Template
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.org
 * @since       1.0
 * @version     $Revision$
 * @author      Mike van Riel <mike.vanriel@naenius.com>
 */
class Doctrine_Template_Listener_Signable extends Doctrine_Record_Listener
{
    /**
     * Array of signable options
     *
     * @var string
     */
    protected $_options = array();

    /**
     * __construct
     *
     * @param string $options
     * @return void
     */
    public function __construct(array $options)
    {
        $this->_options = $options;
    }

    /**
     * Set the created and updated Signable columns when a record is inserted
     *
     * @param Doctrine_Event $event
     * @return void
     */
    public function preInsert(Doctrine_Event $event)
    {
        if ( ! $this->_options['created']['disabled']) {
            $createdName = $event->getInvoker()->getTable()->getFieldName($this->_options['created']['name']);
            $modified = $event->getInvoker()->getModified();
            if ( ! isset($modified[$createdName])) {
                $event->getInvoker()->$createdName = $this->getUserId();
            }
        }

        if ( ! $this->_options['updated']['disabled'] && $this->_options['updated']['onInsert']) {
            $updatedName = $event->getInvoker()->getTable()->getFieldName($this->_options['updated']['name']);
            $modified = $event->getInvoker()->getModified();
            if ( ! isset($modified[$updatedName])) {
                $event->getInvoker()->$updatedName = $this->getUserId();
            }
        }
    }

    /**
     * Set updated Signable column when a record is updated
     *
     * @param Doctrine_Event $evet
     * @return void
     */
    public function preUpdate(Doctrine_Event $event)
    {
        if ( ! $this->_options['updated']['disabled']) {
            $updatedName = $event->getInvoker()->getTable()->getFieldName($this->_options['updated']['name']);
            $modified = $event->getInvoker()->getModified();
            if ( ! isset($modified[$updatedName])) {
                $event->getInvoker()->$updatedName = $this->getUserId();
            }
        }
    }

    /**
     * Set the updated field for dql update queries
     *
     * @param Doctrine_Event $evet
     * @return void
     */
    public function preDqlUpdate(Doctrine_Event $event)
    {
        if ( ! $this->_options['updated']['disabled']) {
            $params = $event->getParams();
            $updatedName = $event->getInvoker()->getTable()->getFieldName($this->_options['updated']['name']);
            $field = $params['alias'] . '.' . $updatedName;
            $query = $event->getQuery();

            if ( ! $query->contains($field)) {
                $query->set($field, '?', $this->getUserId());
            }
        }
    }

    /**
     * Returns the user id as known in the User object.
     *
     * The User object must declare this function, it is not a default symfony method.
     *
     * @return integer|null
     */
    public function getUserId()
    {
    	if (!sfContext::hasInstance()) return null;

    	return sfContext::getInstance()->getUser()->getId();
    }

}