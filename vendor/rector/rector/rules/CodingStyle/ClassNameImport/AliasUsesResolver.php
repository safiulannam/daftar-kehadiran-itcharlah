<?php

declare (strict_types=1);
namespace Rector\CodingStyle\ClassNameImport;

use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\UseUse;
final class AliasUsesResolver
{
    /**
     * @readonly
     * @var \Rector\CodingStyle\ClassNameImport\UseImportsTraverser
     */
    private $useImportsTraverser;
    public function __construct(\Rector\CodingStyle\ClassNameImport\UseImportsTraverser $useImportsTraverser)
    {
        $this->useImportsTraverser = $useImportsTraverser;
    }
    /**
     * @param Stmt[] $stmts
     * @return string[]
     */
    public function resolveFromNode(Node $node, array $stmts) : array
    {
        if (!$node instanceof Namespace_) {
            /** @var Namespace_[] $namespaces */
            $namespaces = \array_filter($stmts, static function (Stmt $stmt) : bool {
                return $stmt instanceof Namespace_;
            });
            if (\count($namespaces) !== 1) {
                return [];
            }
            $node = \current($namespaces);
        }
        return $this->resolveFromStmts($node->stmts);
    }
    /**
     * @param Stmt[] $stmts
     * @return string[]
     */
    public function resolveFromStmts(array $stmts) : array
    {
        $aliasedUses = [];
        $this->useImportsTraverser->traverserStmts($stmts, static function (UseUse $useUse, string $name) use(&$aliasedUses) : void {
            if (!$useUse->alias instanceof Identifier) {
                return;
            }
            $aliasedUses[] = $name;
        });
        return $aliasedUses;
    }
}
