# Práctica 4

 Esta práctica ha sido realizada en conjunto por:

- EDUARDO DA SILVA YANES => alu0101104911
- ALEJANDRO MEDINA GARCÍA => alu0100905885
- CRISTO MANUEL PÉREZ RODRÍGUEZ => alu0101218007

En este caso se nos plantea crear tres disparadores de tal manera que cuando hagamos ciertas acciones en la DB (insertar, actualizar, etc.) estos se activen y realicen unos determinados pasos.

---

### Trigger 1

Este primer trigger tiene como funcion ejecutarse antes de insertar una tupla en CLIENTES y valorar el valor del campo "Correo" (email). Si este es nulo se le creara un correo a partir de su nombre y apellidos. Si la insercion ya poseia un correo este se verificara para comprobar si la estructura es valida.

**Función -> crear_email**

```SQL
CREATE OR REPLACE FUNCTION crear_email() RETURNS TRIGGER AS $example_table$
  BEGIN
    IF NEW.Correo IS NULL THEN
        NEW.Correo = CONCAT(NEW.Nombre,NEW.Apellidos,'@',TG_ARGV[0]);
    ELSIF NEW.Correo !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$' THEN
        NEW.Correo = CONCAT(NEW.Nombre,NEW.Apellidos,'@',TG_ARGV[0]);
    END IF;
    RETURN NEW;
  END;
$example_table$ LANGUAGE 'plpgsql';
```

**Trigger -> trigger_crear_email_before_insert**

```SQL
CREATE TRIGGER trigger_crear_email_before_insert BEFORE INSERT ON viverosdb.CLIENTE
FOR EACH ROW EXECUTE PROCEDURE crear_email('ull.edu.es');
```

---

### Trigger 2

Este segundo disparaador ha sido modificado para adaptarlo al caso que estamos tratando. En nuestro caso verificamos que un vivero no se pueda insertar en la misma zona/ubicación que otro vivero.

**Función -> comparar_ubicacion_trigger**

```SQL
CREATE OR REPLACE FUNCTION comparar_ubicacion_trigger() RETURNS TRIGGER AS $$
BEGIN
  IF (TRUE = ANY(SELECT(NEW.Coordenadas = Coordenadas AND NEW.Localidad = Localidad) FROM viverosdb.VIVERO)) THEN
    RAISE EXCEPTION 'Esa ubicacion ya esta asignada a otro vivero';
  END IF;
  RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';
```

**Trigger -> comprobar_ubicacion_trigger**

```SQL
CREATE TRIGGER comprobar_ubicacion_trigger BEFORE INSERT ON viverosdb.VIVERO
  FOR EACH ROW 
  EXECUTE PROCEDURE comparar_ubicacion_trigger();
```

---

### Trigger 3

Este último trigger permite mantener actualizado el stock de la base de datos cuando se realizan compras.

**Función -> compra_insert_trigger_fnc()**

```SQL
CREATE OR REPLACE FUNCTION compra_insert_trigger_fnc() RETURNS trigger AS $$
BEGIN
        UPDATE viverosdb.PRODUCTO set Stock = Stock - new.Cantidad
        WHERE Código_producto = new.PRODUCTO_Código_producto;
        RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';
```

**Trigger -> compra_insert_trigger**

```SQL
CREATE TRIGGER compra_insert_trigger AFTER INSERT ON viverosdb.COMPRA
FOR EACH ROW EXECUTE PROCEDURE compra_insert_trigger_fnc();
```

---

### IMAGENES DEL RESULTADO

**1. Ejecución del fichero SQL**

![Ejecución](https://github.com/EduardoSY/ADBD_21-22_ULL/blob/main/Practica4/Ejecuci%C3%B3n_fichero.png)

**2. SELECTS de las tablas**

![SELECTS](https://github.com/EduardoSY/ADBD_21-22_ULL/blob/main/Practica4/SELECTS.png)
