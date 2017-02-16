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

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception\CodeIgniter\LegacyBridgeException;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception\CodeIgniter\LegacyRedirectException;
use Theodo\Evolution\Bundle\LegacyWrapperBundle\Exception\CodeIgniter\LegacyUnauthorizedException;

class BasicCodeIgniterKernelBridge extends AbstractCodeIgniterKernelBridge
{
    
    /**
     * @param LegacyUnauthorizedException $lue
     * @return Response
     * @throws LegacyUnauthorizedException
     */
    public function getLegacyUnauthorizedExceptionResponse(LegacyUnauthorizedException $lue)
    {
        throw new AccessDeniedHttpException($lue->getMessage(), $lue);
    }
    
    /**
     * @param LegacyRedirectException $lre
     * @return Response
     */
    public function getLegacyRedirectExceptionResponse(LegacyRedirectException $lre)
    {
        $uri = $lre->getUri();
        $response = new RedirectResponse($uri, Response::HTTP_TEMPORARY_REDIRECT);
        
        return $response;
    }
    
    /**
     * @param LegacyBridgeException $lbe
     * @return Response
     * @throws LegacyBridgeException
     */
    public function getLegacyBridgeExceptionResponse(LegacyBridgeException $lbe)
    {
       throw  $lbe;
    }
}