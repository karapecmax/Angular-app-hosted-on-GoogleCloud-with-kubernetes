# Use the official MySQL image as the base image
FROM mysql:8

# Set the root password and create the 'products' database
ENV MYSQL_DATABASE=products
ENV MYSQL_ROOT_PASSWORD="12345678"

# Copy the initialization script into the container
COPY ./products.sql /docker-entrypoint-initdb.d/
