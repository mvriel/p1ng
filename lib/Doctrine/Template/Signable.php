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
 * Doctrine_Template_Signable
 *
 * Easily add created by and updated by to your doctrine records that are automatically set
 * when records are saved
 *
 * @package     Doctrine
 * @subpackage  Template
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.org
 * @since       1.0
 * @version     $Revision$
 * @author      Mike van Riel <mike.vanriel@naenius.com>
 */
class Doctrine_Template_Signable extends Doctrine_Template
{
    /**
     * Array of Timestampable options
     *
     * @var string
     */
    protected $_options = array('created' =>  array('name'          =>  'created_by',
                                                    'alias'         =>  null,
                                                    'type'          =>  'integer(11)',
    												'user_table'    => 'sfGuardUser',
                                                    'disabled'      =>  false,
                                                    'expression'    =>  false,
                                                    'options'       =>  array('notnull' => false)),
                                'updated' =>  array('name'          =>  'updated_by',
                                                    'alias'         =>  null,
                                                    'type'          =>  'integer(11)',
                                                    'user_table'    =>  'sfGuardUser',
                                                    'disabled'      =>  false,
                                                    'expression'    =>  false,
                                                    'onInsert'      =>  true,
                                                    'options'       =>  array('notnull' => false)));

    /**
     * Set table definition for Timestampable behavior
     *
     * @return void
     */
    public function setTableDefinition()
    {
        if ( ! $this->_options['created']['disabled']) {
            $name = $this->_options['created']['name'];
            if ($this->_options['created']['alias']) {
                $name .= ' as ' . $this->_options['created']['alias'];
            }
            $this->hasColumn($name, $this->_options['created']['type'], null, $this->_options['created']['options']);
        }

        if ( ! $this->_options['updated']['disabled']) {
            $name = $this->_options['updated']['name'];
            if ($this->_options['updated']['alias']) {
                $name .= ' as ' . $this->_options['updated']['alias'];
            }
            $this->hasColumn($name, $this->_options['updated']['type'], null, $this->_options['updated']['options']);
        }

        $this->addListener(new Doctrine_Template_Listener_Signable($this->_options));
    }
    
    public function setUp()
    {
        $this->hasOne($this->_options['created']['user_table'].' as created_by', array(
             'local' => $this->_options['created']['name'],
             'foreign' => 'id'));

        $this->hasOne($this->_options['updated']['user_table'].' as updated_by', array(
             'local' => $this->_options['updated']['name'],
             'foreign' => 'id'));
    }
}