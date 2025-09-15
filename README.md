# 🚀 Laravel Eloquent ORM - Relacionamentos

### 3️⃣ BelongsTo (Relacionamento Inverso)

**Localização**: `/belong-to`

```php
// Implementação ativa:
$phones = Phone::with('client')->get();

foreach ($phones as $phone) {
    echo "<hr><b>Nome: </b> {$phone->client->client_name} | <b>Telefone: </b> {$phone->phone_number} <br>";
}
```

**Características:**

-   ✅ **Relacionamento inverso**: Do telefone para o cliente
-   ✅ **Eager Loading**: `Phone::with('client')`
-   ✅ **Interface formatada**: HTML com separadores
-   ✅ **Dados relacionais**: Nome do cliente + número do telefone

## 🔧 Métodos Helper Implementados

### `showDataWithHTML($client)`

```php
// Renderiza dados de clientes e telefones em HTML
// - Exibe ID e nome do cliente
// - Lista todos os telefones numerados
// - Formatação com <hr> e contadores automáticos
```

### Métodos Herdados (Controller Base)

```php
show_data($data)           // Exibe dados com print_r formatado
array_of_object($data)     // Converte arrays em objetos
```

## 💡 Conceitos Demonstrados

### ⚡ **Performance**

-   **Eager Loading**: Previne o problema N+1 queries
-   **Relacionamentos otimizados**: Uma consulta para múltiplas tabelas

### 🔄 **Tipos de Relacionamentos**

-   **HasOne**: Cliente → Telefone único
-   **HasMany**: Cliente → Múltiplos telefones
-   **BelongsTo**: Telefone → Cliente (inverso)

### 🎨 **Interface & Apresentação**

-   **HTML nativo**: Renderização direta no navegador
-   **Formatação visual**: Separadores e contadores
-   **Dados estruturados**: Organização clara das informações

## 🚀 Como Executar

```bash
# Instalação
composer install && npm install

# Configuração
cp .env.example .env
php artisan key:generate

# Database
touch database/database.sqlite
php artisan migrate

# Desenvolvimento (Multi-processo)
composer run dev
```

## 🌐 URLs de Demonstração

-   🏠 **Home**: http://localhost:8000  
    _Exibe: "ELOQUENT RELATIONSHIPS"_

-   📱 **One-to-One**: http://localhost:8000/one-to-one  
    _Exemplos documentados de relacionamento único_

-   📞 **One-to-Many**: http://localhost:8000/one-to-many  
    _Demonstração ativa: clientes com múltiplos telefones_

-   🔄 **BelongsTo**: http://localhost:8000/belong-to  
    _Relacionamento inverso: telefones → clientes_

## 📋 Scripts Disponíveis

```bash
composer run dev    # Servidor + Queue + Logs + Vite (4 processos)
composer run test   # Executa testes automatizados
```

## 🎯 Status das Implementações

### ✅ **Completamente Implementado**

-   [x] **HasMany**: Cliente → Múltiplos telefones
-   [x] **BelongsTo**: Telefone → Cliente
-   [x] **Eager Loading**: Otimização de consultas
-   [x] **Interface HTML**: Renderização formatada
-   [x] **Helper Methods**: Utilitários de apresentação

### 📝 **Documentado para Estudo**

-   [x] **HasOne**: Cliente → Telefone único (código comentado)
-   [x] **Query examples**: Múltiplas formas de consulta
-   [x] **Best practices**: Tratamento de nulos e validações

## 🧠 Aprendizados Principais

1. **Relacionamentos Bidirecionais**: HasMany ↔ BelongsTo
2. **Eager Loading**: Importância do `with()` para performance
3. **Apresentação de Dados**: HTML nativo vs. JSON/Arrays
4. **Desenvolvimento Moderno**: Multi-process com Vite + Laravel

---

**Repositório**: Laravel-11-12-Framework-Ecossistema-e-Projetos-Web  
**Autor**: MLS467  
_Projeto de estudo - Laravel Eloquent ORM Relationships_
