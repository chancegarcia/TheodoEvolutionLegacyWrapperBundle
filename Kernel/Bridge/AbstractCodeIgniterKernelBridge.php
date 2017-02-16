<?php
/**
 * @package
 * @subpackage
 * @author      Chance Garcia <chance@garcia.codes>
 * @copyright   (C)Copyright 2013-2017 Chance Garcia, chancegarcia.com
 *
 *    The MIT License (MIT)
 *
 * Copyright (c) 2013-2017 Chance Garcia
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace Theodo\Evolution\Bundle\LegacyWrapperBundle\Kernel\Bridge;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception\CodeIgniter\LegacyBridgeException;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception\CodeIgniter\LegacyRedirectException;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception\CodeIgniter\LegacyUnauthorizedException;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Kernel\CodeIgniterKernel;

abstract class AbstractCodeIgniterKernelBridge extends CodeIgniterKernel
{
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        try {
            $response = parent::handle($request, $type, $catch);
        } catch (LegacyUnauthorizedException $lue) {
            $response = $this->getLegacyUnauthorizedExceptionResponse($lue);
        } catch (LegacyRedirectException $lre) {
            $response = $this->getLegacyRedirectExceptionResponse($lre);
        } catch (LegacyBridgeException $lbe) {
            $response = $this->getLegacyBridgeExceptionResponse($lbe);
        }
        
        return $response;
    }
    
    /**
     * @param LegacyUnauthorizedException $lue
     * @return Response
     */
    abstract public function getLegacyUnauthorizedExceptionResponse(LegacyUnauthorizedException $lue);
    
    /**
     * @param LegacyRedirectException $lre
     * @return Response
     */
    abstract public function getLegacyRedirectExceptionResponse(LegacyRedirectException $lre);
    
    /**
     * @param LegacyBridgeException $lbe
     * @return Response
     */
    abstract public function getLegacyBridgeExceptionResponse(LegacyBridgeException $lbe);
}